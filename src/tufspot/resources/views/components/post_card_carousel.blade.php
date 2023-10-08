{{--
    カードの形式を持ってくる
    画像はフリー画像を、縦223*横299pxで
    
    以下phpで複製後に並び替えるのに使えそう
    https://getbootstrap.jp/docs/5.0/components/card/
--}}
{{-- @props(['place' => 'ハロン湾']) --}}

{{-- <div class="carousel-cell" style="left: 400px"> --}}
<div class="carousel-cell">
    <div class="d-flex top-carousel-wrapper justify-content-center">
        <div class="d-block top-carousel-image-wrapper">
            <a href="{{ route('post_detail', ['id' => $post['id']]) }}" class="text-decoration-none">
                <img loading="lazy" src="{{ asset($post['featured_image_path']) }}" class="top-carousel-image" alt="...">
            </a>
        </div>
        <div class="top-carousel-text-wrapper d-flex flex-column justify-content-center">
            <a href="{{ route('post_detail', ['id' => $post['id']]) }}" class="text-decoration-none">
                <p class="top-carousel-title">
                    {{-- {{ $place }}にまた行った。<br>
                    そしたら新しい発見があったはなし。 --}}
                    {!! nl2br($post['title']) !!}
                </p>
                <p class="top-carousel-text">
                    {{-- テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが --}}
                    {!! nl2br($post['description']) !!}
                </p>
            </a>
            <p class="top-carousel-hashtag">
                @foreach ($post['tags'] as $tag)
                    <a href="{{ route('hashtag_result', ['tagSlug' => $tag['slug']]) }}" class="text-decoration-none">#{{ $tag['name'] }}</a>
                @endforeach
                {{-- <a href="{{ route('hashtag_result', ['tagSlug' => 1]) }}" class="text-decoration-none">#ハッシュタグ</a> --}}
                {{-- <a href="{{ route('hashtag_result', ['tagSlug' => 1]) }}" class="text-decoration-none">#ハッシュタグ</a> --}}
            </p>
            <div class="post-card-writer-wrapper">
                <a href="{{ route('writer_detail', ['user' => $post['user']['id']]) }}" class="text-decoration-none">
                    <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <p class="post-card-writer">
                        {{-- Writer Name --}}
                        {{ $post['user']['name'] }}
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>
