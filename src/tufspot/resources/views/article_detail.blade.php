<x-template>
    <x-slot name="title"> TUFSPOT_article_detail </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-bread />
    <x-main>
        <div class="article-detail-wrapper d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('image/article_detail.jpeg') }}" style="width:850px; height:500px;" class="" alt="...">
            {{-- <x-writer_card /> --}}
            <div class="article-title d-flex justify-content-between ">
                <div class="article-title-text">ここにタイトルが入りますここにタイトルが入ります</div>
                <div class="article-title-icon d-flex align-items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
                </div>
            </div>
            <div class="article-detail-writer-wrapper">
                <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <p class="article-detail-writer">
                    Writer Name
                </p>
            </div>
            <div class="article-detail-list">
                {{-- ボーダー用pタグ --}}
                <p class="article-detail-title"></p>
                <div class="article-detail-explain-text-wrapper">
                    <p class="article-detail-explain-text">
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                    </p>
                </div>
                <div class="article-detail-outline d-flex flex-column">
                    <h1 class="article-detail-outline-title">目次</h1>
                    <p class="article-detail-outline-text">ここに目次が入りますここに目次が入ります</p>
                    <p class="article-detail-outline-text">ここに目次が入りますここに目次が入ります</p>
                    <p class="article-detail-outline-text">ここに目次が入りますここに目次が入ります</p>
                    <p class="article-detail-outline-text">ここに目次が入りますここに目次が入ります</p>
                </div>
            </div>
            <div class="article-detail-list">
                <p class="article-detail-headline">
                    大見出し
                </p>
                <div class="article-detail-explain-text-wrapper">
                    <p class="article-detail-explain-text">
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                    </p>
                </div>
                <div class="d-flex flex-column article-detail-explain-image-wrapper">
                    <div class="article-detail-explain-image">
                    </div>
                    <span>ここに写真の説明が入ります</span>
                </div>
                <div class="article-detail-explain-text-wrapper">
                    <p class="article-detail-explain-text">
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                    </p>
                </div>
            </div>
            <div class="article-detail-list">
                <p class="article-detail-headline">
                    まとめ
                </p>
                <div class="article-detail-explain-text-wrapper">
                    <p class="article-detail-explain-text">
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                    </p>
                </div>
            </div>
            <div class="article-detail-list">
                {{-- ボーダー用pタグ --}}
                <p class="article-detail-title writer-last"></p>
                <div class="article-detail-writer-wrapper d-flex align-items-center">
                    <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <p class="article-detail-writer">
                        Writer Name
                    </p>
                    <div class="writer-card-button-wrapper">
                        <a href="#" class="article-card-button text-center">プロフィールを見る</a>
                    </div>
                    <div class="writer-card-button-wrapper">
                        <a href="#" class="article-card-button text-center">フォローする</a>
                    </div>
                </div>
            </div>
        </div>
    </x-main>
    <x-footer />
</x-template>
