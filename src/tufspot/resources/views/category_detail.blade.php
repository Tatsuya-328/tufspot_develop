{{-- Academy等のカテゴリと、〇〇特集、どちらにも使える詳細ページ --}}
<x-template>
    <x-slot name="title"> TUFSPOT_category_detail </x-slot>
    <x-header />
    <x-post_list_title listTitle="Academia" />
    <x-main>
        {{-- <x-post_list_explain /> --}}
        <div class="post_list_explain d-flex flex-column justify-content-center">
            <p class="post_list_explain_text m-0">
                {!! nl2br($category->description) !!}
            </p>
        </div>
        <div class="d-flex justify-content-center flex-wrap">
            {{-- <div class="row row-cols-3"> --}}
            <x-post_card place="ハロン湾" />
            <x-post_card place="スイティエン" />
            <x-post_card place="アンコールワット" />
            {{-- 最終行も左寄せには、空要素入れるしかなさそう https://qiita.com/QUANON/items/e14949abab3711ca8646 --}}
            <x-post_card place="ハロン湾" />
            <x-post_card place="スイティエン" />
            <x-post_card place="アンコールワット" />
        </div>
    </x-main>
    <x-footer />
</x-template>
