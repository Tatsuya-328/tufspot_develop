<x-template>
    <x-slot name="title"> TUFSPOT_feature </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="特集記事一覧" />
    <x-main>
        <div class="feature_box" id="makeImg">
        </div>
        <x-post_list_explain />
        <div class="feature_box" id="makeImg">
        </div>
        <x-post_list_explain />
        <div class="feature_box" id="makeImg">
        </div>
        <x-post_list_explain />

    </x-main>
    <x-footer />
</x-template>
