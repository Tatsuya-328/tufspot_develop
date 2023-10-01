<header class="py-3">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            {{-- <div class="header-left "> --}}
            <a href="{{ route('index') }}" class="header-icon d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                {{-- TUF
                <span>SPOT</span> --}}
                <img src="{{ asset('image/logo_side.png') }}" class="" alt="...">

            </a>
            <form action="{{ route('search_result') }}" method="GET" class="header-search search-form-011">
                @csrf
                <button type="submit" aria-label="検索"></button>
                <label for="search">
                    <input type="text" id="search" name="keywords" placeholder="search">
                </label>
            </form>
            <div class="header-humbeger dropdown text-end btn-group">
                <a href="#" class="d-block link-body-emphasis text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="nav_toggle">
                        <i></i>
                        <i></i>
                        <i></i>
                    </span>
                </a>
                <ul class="dropdown-menu text-small" style="">
                    <li><a class="dropdown-item" href="{{ route('index') }}">Home</a></li>
                    <li><a class="dropdown-item" href="{{ route('about') }}">About</a></li>
                    <li><a class="dropdown-item" href="{{ route('category') }}">CategoryList</a></li>
                    <li><a class="dropdown-item" href="{{ route('writer_list') }}">WriterList</a></li>
                    <li><a class="dropdown-item" href="{{ route('mypage') }}">Mypage</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Sign out</a></li>

                </ul>
            </div>
        </div>
    </div>
</header>
