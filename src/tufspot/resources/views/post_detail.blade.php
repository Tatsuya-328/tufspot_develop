<x-template>
    <x-slot name="title"> TUFSPOT_post_detail </x-slot>
    <x-header />
    <x-bread />
    @if (Request::method() === 'POST' || Request::method() === 'PUT')
        <div class="alert alert-warning d-flex align-items-center mt-4 justify-content-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                このタブはプレビュー画面です。元のタブに編集は残っています。<br>
                タブに戻って編集を完了してください。
            </div>
        </div>
    @endif
    <x-main>
        <div class="post-detail-wrapper d-flex flex-column justify-content-center align-items-center">
            <img class="post-top-img" src="{{ asset('image/post_detail.jpeg') }}" class="" alt="...">
            <div class="post-title">
                <div class="post-title-text">{!! nl2br($post->title) !!}</div>
                {{-- いいねボタンはユーザー名の隣に移動 --}}
                {{-- <div class="post-title-icon align-items-start"> --}}
                {{-- 初期リリース時3点リーダーに機能ないため非表示 --}}
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots ms-2" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg> --}}
                {{-- </div> --}}
            </div>
            <div class="post-detail-writer-wrapper d-flex justify-content-between">
                @if (Request::method() === 'POST' || Request::method() === 'PUT')
                    <a href="#" class="text-decoration-none">
                        <svg class="post-detail-user-icon d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <p class="post-detail-writer">
                            Writer Name
                        </p>
                    </a>
                @else
                    <a href="{{ route('writer_detail', ['user' => $post['user']['id']]) }}" class="text-decoration-none">
                        <svg class="post-detail-user-icon d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <p class="post-detail-writer">
                            {{ $post['user']['name'] }}
                        </p>
                    </a>
                @endif
                {{-- adminからのpreview用に分岐。存在しないデータ --}}
                @if (Request::method() === 'POST' || Request::method() === 'PUT')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart post-detail-like-icon" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                    </svg>
                @else
                    <livewire:like :post="$post" />
                @endif
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
            <div class="post-detail-list">
                {{-- ボーダー用pタグ --}}
                <p class="post-detail-border writer-last"></p>
                <div class="post-detail-writer-wrapper d-flex align-items-center flex-wrap">
                    @if (Request::method() === 'POST' || Request::method() === 'PUT')
                        <a href="#" class="text-decoration-none">
                            <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                            <p class="post-detail-writer">
                                Writer Name
                            </p>
                        </a>
                        <div class="writer-card-button-wrapper">
                            <a href="#" class="post-card-button text-center me-2">プロフィールを見る</a>
                        </div>
                        <div class="writer-card-button-wrapper">
                            <a href="#" class="post-card-button text-center">フォローする</a>
                        </div>
                    @else
                        <a href="{{ route('writer_detail', ['user' => $post['user']['id']]) }}" class="text-decoration-none">
                            <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                            <p class="post-detail-writer">
                                {{ $post['user']['name'] }}
                            </p>
                        </a>
                        <div class="writer-card-button-wrapper d-flex flex-wrap m-3">
                            <a href="{{ route('writer_detail', ['user' => $post['user']['id']]) }}" class="post-card-button text-center me-2">プロフィールを見る</a>
                            @if (!$post->user->isAuthUser())
                                <livewire:follow :followed_user="$post->user" />
                            @endif
                        </div>
                    @endif
                </div>
            </div>
    </x-main>
    <x-footer />
</x-template>
