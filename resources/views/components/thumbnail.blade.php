@php
if($type === 'images'){
  $path = 'storage/images/';
}
if($type === 'products'){
  $path = 'storage/products/';
}

@endphp

<div>
  @if(empty($filename))
    <img src="{{ asset('images/avatar-default.svg')}}"  style="object-fit: cover; width: 200px; height: 200px;" >
  @else
    <img src="{{ asset($path . $filename)}}"  style="object-fit: cover; width: 200px; height: 200px;" >
  @endif
</div>