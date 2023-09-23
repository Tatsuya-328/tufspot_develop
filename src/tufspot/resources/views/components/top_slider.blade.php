@props(['title' => 'Pick Up', 'text' => '注目記事', 'slide_type' => '', 'detail_type' => '', 'slug' => ''])
<div class="top_pickup_wrapper {{ $slide_type }}">
    @if (!empty($slide_type))
        {{-- 特集スライダー --}}
        <a href="{{ route('category') }}" class="link-opacity-100-hover text-decoration-none">
            <div class="top_pickup_title_wrapper fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                </svg>
                <div class="top_pickup_title">
                    {{ $title }}
                </div>
                <div class="top_pickup_title_text"><span>ー</span>{{ $text }}<span>ー</span></div>
            </div>
        </a>
    @else
        {{-- 注目記事スライダー --}}
        {{-- 「注目記事」特集項目に遷移 --}}
        <a href="{{ route('category_detail', [$detail_type, $slug]) }}" class="link-opacity-100-hover text-decoration-none">
            <div class="top_pickup_title_wrapper fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                </svg>
                <div class="top_pickup_title">
                    {{ $title }}
                </div>
                <div class="top_pickup_title_text"><span>ー</span>{{ $text }}<span>ー</span></div>
            </div>
        </a>
    @endif
    <ul class="slider">
        @foreach ($posts as $post)
            <x-post_card :post=$post />
        @endforeach
        {{-- <x-post_card place="スイティエン" />
        <x-post_card place="アンコールワット" />
        <x-post_card place="ハロン湾" />
        <x-post_card place="スイティエン" />
        <x-post_card place="アンコールワット" /> --}}
    </ul>
</div>
