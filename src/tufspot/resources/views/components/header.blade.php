<header class="py-3">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            {{-- <div class="header-left "> --}}
            <a href="{{ route('index') }}" class="header-icon d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                {{-- TUF
                <span>SPOT</span> --}}
                <img loading="lazy" src="{{ asset('image/logo_side.png') }}" class="" alt="...">
            </a>
            <form action="{{ route('search_result') }}" method="GET" class="d-flex">
                @csrf
                <div class="header-search search-form-011">
                    {{-- 検索対象のモーダル表示ボタン submitから変更 --}}
                    {{-- <button type="submit" aria-label="検索"></button> --}}
                    <button id="open-modal" type="button" aria-label="検索" data-bs-toggle="modal" data-bs-target="#headerSearchModal"></button>
                    <label for="search">
                        <input type="text" id="search" name="keywords" placeholder="search">
                    </label>
                </div>
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
{{-- モーダルここから --}}
<div class="modal fade" id="headerSearchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="headerSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headerSearchModalLabel">検索項目選択</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('search_result') }}" method="GET" class="">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control mb-3" name="keywords" id="search_text_modal">
                    <select name="search_filter" class="form-select">
                        @foreach (config('common.search_filter') as $key => $value)
                            <option value="{{ $key }}" {{ $key === 'all' ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- モーダルここまで --}}
<script>
    // Enterで送信せずにモーダル表示
    // window.onload = function() {
    $(function() {
        $("input").keydown(function(e) {
            if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
                // モーダル内のテキストボックスに代入
                $('#search_text_modal').val($('#search').val());
                $('#open-modal').trigger("click");
                return false;
            } else {
                return true;
            }
        });
    });
</script>
