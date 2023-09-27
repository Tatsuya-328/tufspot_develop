<x-template>
    <x-slot name="title"> TUFSPOT_top </x-slot>
    <x-header />
    {{-- Caroursel --}}
    {{-- 最新記事5つ表示 --}}
    <div class="top-wrapper">
        <div class="top-ariticle-slide">
            <div class="carousel" data-flickity='{ "wrapAround": true, "cellAlign": "left", "autoPlay": 3000}'>
                @foreach ($carousel_posts as $post)
                    <x-post_card_carousel :post=$post />
                @endforeach
                {{-- <x-post_card_carousel place="スイティエン" />
                <x-post_card_carousel place="アンコールワット" /> --}}
            </div>
        </div>
    </div>

    {{-- Pick Up --}}
    {{-- ランダム10 --}}
    {{-- これは「注目記事」という特集にした方がよい？ --}}
    <x-top_slider title="Pick Up" text="注目記事" detail_type="feature" slug="pickup" :posts=$pickup_posts />

    {{-- Academia etc... --}}
    {{-- それぞれ最新を6つずつ --}}
    {{-- TODO:　sulgをDBから持ってくる --}}
    <x-top_category title="Academia" type="category" slug="academia" imagePath="image/BOOK.png" :posts=$academia_posts />
    <x-top_category title="Business and Career" type="category" slug="business-and-career" imagePath="image/TALK.png" :posts=$business_posts />
    <x-top_category title="Culture and Essay" type="category" slug="culture-and-essay" imagePath="image/EARTH.png" :posts=$culture_posts />

    {{-- Feature --}}
    {{-- ランダム10 --}}
    <x-top_slider title="Feature" text="特集" slide_type="特集" :posts=$feature_posts />

    <div class="top_links_wrapper d-flex justify-content-center ">
        <div class="top_links d-flex align-items-center justify-content-center">
            <a href="#" class="text-decoration-none link-light">東京外語会</a>
        </div>
        <div class="top_links d-flex align-items-center justify-content-center">
            <a href="#" class="text-decoration-none link-light">TUFS Community</a>
        </div>
        <div class="top_links d-flex align-items-center justify-content-center">
            <a href="#" class="text-decoration-none link-light">東京外語会</a>
        </div>
        <div class="top_links d-flex align-items-center justify-content-center">
            <a href="#" class="text-decoration-none link-light">TUFS Community</a>
        </div>
    </div>
    <x-main>
    </x-main>
    <x-footer />
</x-template>
