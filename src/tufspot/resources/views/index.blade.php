<x-template>
    <x-slot name="title"> TUFSPOT_top </x-slot>
    <x-header />
    {{-- Caroursel --}}
    {{-- 最新記事5つ表示 --}}
    <div class="top-wrapper">
        <div class="top-ariticle-slide">
            <div class="carousel" data-flickity='{ "wrapAround": true, "cellAlign": "left", "autoPlay": 3000}'>
                <x-article_card_carousel place="ハロン湾" />
                <x-article_card_carousel place="スイティエン" />
                <x-article_card_carousel place="アンコールワット" />
            </div>
        </div>
    </div>

    {{-- Pick Up --}}
    {{-- ランダム10 --}}
    <x-top_slider title="Pick Up" text="注目記事" />

    {{-- Academia etc... --}}
    {{-- それぞれ最新を6つずつ --}}
    <x-top_category title="Academia" imagePath="image/BOOK.png" />
    <x-top_category title="Business and Career" imagePath="image/TALK.png" />
    <x-top_category title="Culture and Essay" imagePath="image/EARTH.png" />

    {{-- Feature --}}
    {{-- ランダム10 --}}
    <x-top_slider title="Feature" text="特集" type="feature" />

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
