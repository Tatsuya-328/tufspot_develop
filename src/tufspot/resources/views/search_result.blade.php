<x-template>
    <x-slot name="title"> TUFSPOT_result </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="検索結果" />
    <x-main>
        {{-- TODO: 検索ワードのスタイリングはいったんカテゴリーからとってきてる、要修正 --}}
        <div class="post_list_explain d-flex flex-column justify-content-center">
            @foreach ($keywordArr as $keyword)
                <p class="post_list_explain_text m-0">
                    {{ $keyword }}
                </p>
            @endforeach
        </div>
        <div class="article-list-area">
            <livewire:paginated-post-list :keywords="$keywordArr" page_flag="search" />
        </div>
    </x-main>
    <x-footer />
</x-template>
