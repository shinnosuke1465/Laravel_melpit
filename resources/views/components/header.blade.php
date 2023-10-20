<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/images/logo-1.png" style="height: 39px;" alt="Melpit">
        </a>

        <div class="navbar-collapse flex-row-reverse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <form class="flex flex-wrap" method="GET" action="{{ route('top') }}">
                    <div class="relative flex items-stretch">
                        <div>
                            <select class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md" name="category">
                                <option value="">全て</option>
                                @foreach ($categories as $category)
                                    <option value="primary:{{$category->id}}" class="font-bold">{{$category->name}}</option>
                                    @foreach ($category->secondaryCategories as $secondary)
                                        <option value="secondary:{{$secondary->id}}">{{$secondary->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <input type="text" name="keyword" class="form-input block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" aria-label="Text input with dropdown button" placeholder="キーワード検索">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                
                @guest
                    {{-- 非ログイン --}}
                    <li class="nav-item">
                        <a class="btn btn-secondary ml-3" href="{{ route('register') }}" role="button">会員登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-info ml-2" href="{{ route('login') }}" role="button">ログイン</a>
                    </li>
                @else
                    {{-- ログイン済み --}}
                    <li class="nav-item dropdown ml-2">
                        {{-- ログイン情報 --}}
                        <a id="navbarDropdown" class="flex items-center nav-link dropdown-toggle" role="button">
                            @if (!empty($user->avatar_file_name))
                                <img src="{{asset('storage/images/' .$user->avatar_file_name) }}"class="rounded-circle"
                                    style="object-fit: cover; width: 35px; height: 35px;">
                            @else
                                <img src="/images/avatar-default.svg" class="rounded-circle"
                                    style="object-fit: cover; width: 35px; height: 35px;">
                            @endif
                            {{ $user->name }} <span class="caret"></span>
                        </a>
                        <!-- ドロップダウンメニュー -->
                        <div id="dropdownMenu"
                            class="origin-top-right right-0 absolute rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
                            style="position: absolute;left: -20px;width: 11rem; display: none;" aria-labelledby="navbarDropdown">
                            <div class="py-1" role="none">
                                <!-- アイテム -->
                                <a class="dropdown-item px-2 py-2" href="{{ route('sell') }}">
                                    <i class="fas fa-camera text-left" style="width: 30px"></i>商品を出品する
                                </a>
                                <a class="dropdown-item px-2 py-2" href="{{ route('mypage.sold-items') }}">
                                    <i class="fas fa-store-alt text-left" style="width: 30px"></i>出品した商品
                                </a>
                                <a class=" px-2 py-2 dropdown-item"
                                    role="menuitem"
                                    href="{{ route('mypage.edit-profile') }}">
                                    <i class="far fa-address-card text-left" style="width: 30px;"></i> プロフィール編集
                                </a>

                                <a class="px-2 py-2 dropdown-item"
                                    role="menuitem" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt text-left" style="width: 30px"></i>ログアウト
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
