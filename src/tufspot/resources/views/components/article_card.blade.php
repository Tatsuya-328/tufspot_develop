{{--
    カードの形式を持ってくる
    画像はフリー画像を、縦223*横299pxで
    
    以下phpで複製後に並び替えるのに使えそう
    https://getbootstrap.jp/docs/5.0/components/card/
--}}
@props(['place' => 'ハロン湾'])

<div class="article_card" style="">
    <a href="{{ route('article_detail', ['id' => 1]) }}" class="text-decoration-none">
        <img src="{{ asset('image/' . $place . '.jpeg') }}" class="article_card_img" alt="...">
    </a>
    <div class="card-body">
        <p class="fw-bold article-card-text">
            <a href="{{ route('article_detail', ['id' => 1]) }}" class="text-decoration-none">
                ここに記事のタイトルが入ります<br>
                ここに記事のタイトルが入ります。
                <br>
            </a>
            <span class="article-card-hashtag">
                <a href="{{ route('hashtag_result', ['tagSlug' => 1]) }}" class="text-decoration-none">#ハッシュタグ</a>
                <a href="{{ route('hashtag_result', ['tagSlug' => 1]) }}" class="text-decoration-none">#ハッシュタグ</a>
            </span>
        </p>
        <div>
            <a href="{{ route('writer_detail', ['id' => 1]) }}" class="text-decoration-none">
                <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <p class="article-card-writer">
                    Writer Name
                </p>
            </a>
        </div>
    </div>
</div>
