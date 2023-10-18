@extends('layouts.app')

@section('title')
    商品一覧
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap -m-4">
            @foreach ($items as $item)
                <div class="p-4 w-full md:w-1/4">
                    <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden">
                        <div class="relative responsive-image">
                            <x-thumbnail :filename="$item->image_file_name" type="products" />
                            <div class="position-absolute py-2 px-3"
                                style="left: 0; bottom: 13px; color: white; background-color: rgba(0, 0, 0, 0.70)">
                                <i class="fas fa-yen-sign"></i>
                                <span class="ml-1">{{ number_format($item->price) }}</span>
                            </div>
                            @if ($item->isStateBought)
                                <span
                                class="absolute top-0 left-0 bg-red-600 text-white font-bold flex justify-center items-end transform -translate-x-1/2 -translate-y-1/2 rotate-45 w-32 h-32 text-xl"></span>
                                <span class="absolute text-lg  top-[calc(-5px)] left-[calc(-5px)] rotate-[-45deg] text-white font-bold sm:top-[-8px] md:text-xs lg:top-[-8px] lg:text-lg xl:text-xl">SOLD</span>
                            @endif
                        </div>
                        <div class="p-6">
                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                {{ $item->secondaryCategory->primaryCategory->name }} / {{ $item->secondaryCategory->name }}
                            </h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $item->name }}</h1>
                            <div class="flex items-center flex-wrap">
                                <a href="{{ route('item', [$item->id]) }}"
                                    class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center">
            {{ $items->links() }}
        </div>
    </div>

    <a href="{{ route('sell') }}"
        class="fixed bottom-6 right-6 bg-gray-800 text-white w-24 h-24 rounded-full flex items-center justify-center text-2xl"
        role="button">
        出品
        <i class="fas fa-camera ml-2 text-3xl"></i>
    </a>
@endsection
