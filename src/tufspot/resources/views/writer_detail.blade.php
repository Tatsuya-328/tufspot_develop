<x-template>
    <x-slot name="title"> TUFSPOT_writer_detail </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-bread />
    <x-main>
        <div class="writer-detail-wrapper d-flex flex-column justify-content-center align-items-center flex-wrap">
            <x-writer_card :writer=$user />
            <div class="writer-detail-list">
                <p class="writer-detail-title">
                    ▼<span>自己紹介</span>
                </p>
                <div class="">
                    <p class="writer-detail-explain-text">
                        {{ $user->introduction }}
                        {{-- ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。 --}}
                    </p>
                </div>
            </div>
            @if ($user->snsAccounts->isNotEmpty())
                <div class="writer-detail-list">
                    <p class="writer-detail-title">
                        ▼<span>各種SNS</span>
                    </p>
                    <div class="writer-detail-sns-wrapper">
                        @foreach ($user->snsAccounts as $snsAccount)
                            <div class="writer-detail-sns-text d-flex">
                                <div class="writer-detail-sns-account">
                                    {{ $snsAccount['name'] }}
                                </div>
                                <div>
                                    ：<a href="{{ $snsAccount['url'] }}" target="_blank" rel="noopener noreferrer">{{ $snsAccount['url'] }}</a>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="writer-detail-sns-text d-flex">
                            <div class="writer-detail-sns-account">
                                Instagram
                            </div>
                            <div>
                                ：xxxxxxxxxx.com
                            </div>
                    </div>
                    <div class="writer-detail-sns-text d-flex">
                        <div class="writer-detail-sns-account">
                            Facebook
                        </div>
                        <div>
                            ：xxxxxxxxxx.com
                        </div>
                    </div> --}}
                    </div>
                </div>
            @endif
            <div class="writer-detail-list">
                <p class="writer-detail-title">
                    ▼<span>記事</span>
                </p>
                <livewire:paginated-post-list :user="$user" page_flag="writer_detail" />
                {{-- TODO 記事表示 --}}
                {{-- <div class="row row-cols-3"> --}}
                {{-- <x-post_card place="ハロン湾" />
                    <x-post_card place="スイティエン" />
                    <x-post_card place="アンコールワット" /> --}}
                {{-- 最終行も左寄せには、空要素入れるしかなさそう https://qiita.com/QUANON/items/e14949abab3711ca8646 --}}
                {{-- <x-post_card place="ハロン湾" />
                    <x-post_card place="スイティエン" />
                    <x-post_card place="アンコールワット" /> --}}
            </div>
        </div>
    </x-main>
    <x-footer />
</x-template>
