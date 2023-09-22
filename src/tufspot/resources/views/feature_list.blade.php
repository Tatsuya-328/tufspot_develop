<x-template>
    <x-slot name="title"> TUFSPOT_feature </x-slot>
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="特集一覧" />
    <x-main>
        {{-- TODO: 特集一覧（〇〇特集, ✖️✖️特集, △△特集,,,を全て表示して、それぞれのまとめへ遷移） --}}
        {{-- @foreach ($collection as $item) --}}
        <div class="feature_box" id="makeImg">
        </div>
        <div class="post_list_explain d-flex flex-column justify-content-center">
            <p class="post_list_explain_text m-0">
                ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
            </p>
        </div>
        {{-- @endforeach --}}

        {{-- <div class="feature_box" id="makeImg">
        </div>
        <x-post_list_explain />
        <div class="feature_box" id="makeImg">
        </div>
        <x-post_list_explain /> --}}
    </x-main>
    <x-footer />
</x-template>
