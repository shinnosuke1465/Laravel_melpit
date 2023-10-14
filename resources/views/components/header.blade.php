<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/images/logo-1.png" style="height: 39px;" alt="Melpit">
        </a>

        <div class="collapse navbar-collapse flex-row-reverse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button">
                            @if (!empty($user->avatar_file_name))
                                <img src="storage/images/{{ $user->avatar_file_name }}" class="rounded-circle"
                                    style="object-fit: cover; width: 35px; height: 35px;">
                            @else
                                <img src="/images/avatar-default.svg" class="rounded-circle"
                                    style="object-fit: cover; width: 35px; height: 35px;">
                            @endif
                            {{ $user->name }} <span class="caret"></span>
                        </a>
                        <!-- ドロップダウンメニュー -->
                        <div id="dropdownMenu"
                            class="origin-top-right absolute right-0 absolute rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
                            style="position: absolute;left: -20px;width: 11rem; display: none;" aria-labelledby="navbarDropdown">
                            <div class="py-1" role="none">
                                <!-- アイテム -->
                                <a class="dropdown-item px-2 py-2" href="{{ route('sell') }}">
                                    <i class="fas fa-camera text-left" style="width: 30px"></i>商品を出品する
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
