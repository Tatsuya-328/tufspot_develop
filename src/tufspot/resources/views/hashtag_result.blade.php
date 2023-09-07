<x-template>
    <x-slot name="title"> TUFSPOT_hashtag </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-article_list_title class="unset-shadow" listTitle="#ハッシュタグ" />
    <x-main>
        <div class="d-flex justify-content-center flex-wrap">
            {{-- <div class="row row-cols-3"> --}}
            <x-article_card place="ハロン湾" />
            <x-article_card place="スイティエン" />
            <x-article_card place="アンコールワット" />
            {{-- 最終行も左寄せには、空要素入れるしかなさそう https://qiita.com/QUANON/items/e14949abab3711ca8646 --}}
            <div class="article_card">
            </div>
            {{-- <div class="article_card">
            </div>
            <div class="article_card">
            </div> --}}
        </div>
    </x-main>
    <x-footer />
</x-template>
