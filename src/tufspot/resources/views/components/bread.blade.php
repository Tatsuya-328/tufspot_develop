@props(['hoge' => 'このメッセージはデフォルトです。'])

<div class="container">
    <nav class="breadcrumb-wrapper" aria-label="breadcrumb">
        <ol class="breadcrumb {{ Request::routeIs('about', 'category', 'writer_list', 'mypage') ? 'invisible' : '' }}">
            <li class="breadcrumb-item d-flex justify-content-center align-content-center">
                {{-- <a class="link-body-emphasis" href="#">
                <svg class="bi" width="16" height="16">
                    <use xlink:href="#house-door-fill"></use>
                </svg>
                <span class="visually-hidden">Home</span>
            </a> --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                {{-- <a class="link-body-emphasis fw-semibold text-decoration-none" href="#">
                Home
            </a>  --}}
            </li>
            {{-- <li class="breadcrumb-item">
            <a class="link-body-emphasis fw-semibold text-decoration-none" href="#">
                Library
            </a>
        </li> --}}
            <li class="active bread-text" aria-current="page">
                @if (Request::is('category/list/*', 'feature/list/*'))
                    <a href="{{ route('category') }}" class="text-decoration-none">カテゴリー一覧</a>
                @elseif(Request::is('writer/*'))
                    <a href="{{ route('writer_list') }}" class="text-decoration-none">ライター一覧</a>
                @else
                    <a href="{{ route('index') }}" class="text-decoration-none">TOP</a>
                @endif
            </li>
        </ol>
    </nav>
</div>
