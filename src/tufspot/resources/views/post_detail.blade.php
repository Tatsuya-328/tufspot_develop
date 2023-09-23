<x-template>
    <x-slot name="title"> TUFSPOT_post_detail </x-slot>
    <x-header />
    <x-bread />
    <x-main>
        <div class="post-detail-wrapper d-flex flex-column justify-content-center align-items-center">
            <img class="post-top-img" src="{{ asset('image/post_detail.jpeg') }}" class="" alt="...">
            {{-- <x-writer_card /> --}}
            <div class="post-title">
                <div class="post-title-text">{!! nl2br($post->title) !!}</div>
                <div class="post-title-icon align-items-start">
                    {{-- <img src="{{ asset($post->featured_image_path) }}" style="width:850px; height:500px;" class="" alt="...">
                        <div class="post-title d-flex justify-content-between ">
                        <div class="post-title-text">{{ $post->title }}</div>
                        <div class="post-title-icon d-flex align-items-start"> --}}
                    <livewire:like :post="$post" />
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots ms-2" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
                </div>
            </div>
            <div class="post-detail-writer-wrapper">
                <a href="{{ route('writer_detail', ['user' => $post['user']['id']]) }}" class="text-decoration-none">
                    <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <p class="post-detail-writer">
                        {{ $post['user']['name'] }}
                        {{-- Writer Name --}}
                    </p>
                </a>
            </div>
            <div class="post-detail-list">
                {{-- ボーダー用pタグ --}}
                <p class="post-detail-border"></p>
                <div class="post-detail-explain-text-wrapper">
                    <p class="post-detail-explain-text">
                        {!! nl2br($post->description) !!}
                    </p>
                </div>
                {{-- 目次 --}}
                <div class="mokuji"></div>
            </div>
            {{-- quill editor --}}
            <div id="quill_editor" class="post-detail-list">
                <?= $post['body'] ?>
            </div>
            {{-- Quillと代替ここから --}}
            {{-- <div class="post-detail-list">
                ボーダー用pタグ
                <p class="post-detail-border"></p>
                <div class="post-detail-explain-text-wrapper">
                    <p class="post-detail-explain-text">
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。<br>
                    </p>
                </div>
                <div class="post-detail-outline d-flex flex-column">
                    <h1 class="post-detail-outline-title">目次</h1>
                    <p class="post-detail-outline-text">ここに目次が入りますここに目次が入ります</p>
                    <p class="post-detail-outline-text">ここに目次が入りますここに目次が入ります</p>
                    <p class="post-detail-outline-text">ここに目次が入りますここに目次が入ります</p>
                    <p class="post-detail-outline-text">ここに目次が入りますここに目次が入ります</p>
                </div>
            </div>
            <div class="post-detail-list">
                <p class="post-detail-headline">
                    大見出し
                </p>
                <div class="post-detail-explain-text-wrapper">
                    <p class="post-detail-explain-text">
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
                <div class="d-flex flex-column post-detail-explain-image-wrapper">
                    <div class="post-detail-explain-image">
                    </div>
                    <span>ここに写真の説明が入ります</span>
                </div>
                <div class="post-detail-explain-text-wrapper">
                    <p class="post-detail-explain-text">
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
            <div class="post-detail-list">
                <p class="post-detail-headline">
                    まとめ
                </p>
                <div class="post-detail-explain-text-wrapper">
                    <p class="post-detail-explain-text">
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
            </div> --}}
            {{-- Quillと代替ここまで --}}
            <div class="post-detail-list">
                {{-- ボーダー用pタグ --}}
                <p class="post-detail-border writer-last"></p>
                <div class="post-detail-writer-wrapper d-flex align-items-center">
                    <a href="{{ route('writer_detail', ['user' => $post['user']['id']]) }}" class="text-decoration-none">
                        <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <p class="post-detail-writer">
                            {{-- Writer Name --}}
                            {{ $post['user']['name'] }}
                        </p>
                    </a>
                    <div class="writer-card-button-wrapper">
                        <a href="{{ route('writer_detail', ['user' => $post['user']['id']]) }}" class="post-card-button text-center me-2">プロフィールを見る</a>
                    </div>
                    @if (Auth::id() != $post->user->id)
                        <livewire:follow :followed_user="$post->user" />
                    @endif
                </div>
            </div>
    </x-main>
    <x-footer />
</x-template>
