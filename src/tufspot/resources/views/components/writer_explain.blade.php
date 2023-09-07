{{-- @props(['class' => '', 'listTitle' => '']) --}}

<div class="writer-list d-flex">
    <x-writer_card />
    <div class="writer-explain-wrapper">
        <div class="writer-explain">
            <a href="{{ route('writer_detail', ['id' => 1]) }}" class="text-decoration-none">
                <p class="writer-explain-title">▼自己紹介</p>
                <p class="writer-explain-text">
                    ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                    ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                    ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                </p>
            </a>
            <p class="writer-explain-hashtag">
                <a href="{{ route('hashtag_result', ['id' => 1]) }}" class="text-decoration-none">#ハッシュタグ</a>
                <a href="{{ route('hashtag_result', ['id' => 1]) }}" class="text-decoration-none">#ハッシュタグ</a>
                <a href="{{ route('hashtag_result', ['id' => 1]) }}" class="text-decoration-none">#ハッシュタグ</a>
                <a href="{{ route('hashtag_result', ['id' => 1]) }}" class="text-decoration-none">#ハッシュタグ</a>
            </p>
        </div>
        <a href="#" class="writer-link text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="align-text-top d-inline bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
            </svg>
            ライターページに戻る
        </a>
    </div>
</div>
