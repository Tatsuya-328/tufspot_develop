<x-template>
    <x-slot name="title"> TUFSPOT_result </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="検索結果" />
    <x-main>
        {{-- TODO: 検索ワードのスタイリングはいったんカテゴリーからとってきてる、要修正 --}}
        <div class="post_list_explain d-flex flex-column flex-md-row justify-content-around">
            <p class="text-center">
                検索範囲：
                [{{ config('common.search_filter')[$search_filter] }}]
            </p>
            <p class="text-center">
                検索ワード：
                @foreach ($keywordArr as $keyword)
                    "{{ $keyword }}"
                @endforeach
            </p>
        </div>
        <div class="article-list-area">
            <livewire:paginated-post-list :keywords="$keywordArr" :search_filter="$search_filter" page_flag="search" />
        </div>
    </x-main>
    <x-footer />
</x-template>
