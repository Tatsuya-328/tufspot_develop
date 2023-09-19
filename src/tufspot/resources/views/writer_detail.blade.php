<x-template>
    <x-slot name="title"> TUFSPOT_writer_detail </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-bread />
    <x-main>
        <div class="writer-detail-wrapper d-flex flex-column justify-content-center align-items-center flex-wrap">
            <x-writer_card writer_name='{{ $user->name }}' writer_id='{{ $user->id }}' />
            <div class="writer-detail-list">
                <p class="writer-detail-title">
                    ▼<span>自己紹介</span>
                </p>
                <div class="">
                    <p class="writer-detail-explain-text">
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                        ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                    </p>
                </div>
            </div>
            <div class="writer-detail-list">
                <p class="writer-detail-title">
                    ▼<span>各種SNS</span>
                </p>
                <div class="writer-detail-sns-wrapper">
                    <div class="writer-detail-sns-text d-flex">
                        <div class="writer-detail-sns-account">
                            Twitter
                        </div>
                        <div>
                            ：xxxxxxxxxx.com
                        </div>
                    </div>
                    <div class="writer-detail-sns-text d-flex">
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
                    </div>
                </div>
            </div>
            <div class="writer-detail-list">
                <p class="writer-detail-title">
                    ▼<span>記事</span>
                </p>
                <div class="d-flex justify-content-center flex-wrap">
                    {{-- <div class="row row-cols-3"> --}}
                    <x-article_card place="ハロン湾" />
                    <x-article_card place="スイティエン" />
                    <x-article_card place="アンコールワット" />
                    {{-- 最終行も左寄せには、空要素入れるしかなさそう https://qiita.com/QUANON/items/e14949abab3711ca8646 --}}
                    <x-article_card place="ハロン湾" />
                    <x-article_card place="スイティエン" />
                    <x-article_card place="アンコールワット" />
                </div>
            </div>
        </div>
    </x-main>
    <x-footer />
</x-template>
