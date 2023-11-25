<x-template>
    <x-slot name="title"> TUFSPOT_hashtag </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="#ハッシュタグ" />
    <x-main>
        {{-- TODO: 検索ワードのスタイリングはいったんカテゴリーからとってきてる、要修正 --}}
        <div class="post_list_explain d-flex flex-column justify-content-center">
            <p class="post_list_explain_text m-0">
                #{{ $tag_name }}
            </p>
        </div>
        <div class="article-list-area">
            <livewire:paginated-post-list :tag_slug="$tag_slug" page_flag="hashtag" />
        </div>
    </x-main>
    <x-footer />
</x-template>
