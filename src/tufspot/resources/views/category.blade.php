{{-- Academy等のカテゴリと、〇〇特集の項目自体を一覧で表示、遷移してdetailへ --}}
<x-template>
    <x-slot name="title"> TUFSPOT_category </x-slot>
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="特集一覧" />
    <x-main>
        {{-- TODO: 特集一覧（〇〇特集, ✖️✖️特集, △△特集,,,を全て表示して、それぞれのまとめへ遷移） --}}
        @foreach ($categories as $category)
            {{-- <div class="feature_box" id="makeImg"></div> --}}
            <div class="mt-5 post_list_explain d-flex flex-column justify-content-center">
                <a class="text-decoration-none gray_color" href="{{ route('category_detail', ['category', $category->slug]) }}">
                    <h2 class="text-center mb-5 gray_color">{{ $category->name }}</h2>
                    <p class="post_list_explain_text m-0">
                        {!! nl2br($category->description) !!}
                        {{-- ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                    ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                    ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。 --}}
                    </p>
                </a>
            </div>
        @endforeach
        @foreach ($features as $feature)
            {{-- <div class="feature_box" id="makeImg"></div> --}}
            <div class="post_list_explain d-flex flex-column justify-content-center">
                <a class="text-decoration-none gray_color" href="{{ route('category_detail', ['feature', $feature->slug]) }}">
                    <h2 class="text-center mb-4 gray_color">{{ $feature->name }}</h2>
                    <p class="post_list_explain_text m-0">
                        {!! nl2br($feature->description) !!}
                        {{-- ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。
                ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。ここに記事が書かれます。 --}}
                    </p>
                </a>
            </div>
        @endforeach

        {{-- <div class="feature_box" id="makeImg">
        </div>
        <x-post_list_explain />
        <div class="feature_box" id="makeImg">
        </div>
        <x-post_list_explain /> --}}
    </x-main>
    <x-footer />
</x-template>
