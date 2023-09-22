<x-template>
    <x-slot name="title"> TUFSPOT_list </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-post_list_title listTitle="Academia" />
    <x-main>
        <x-post_list_explain />
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
