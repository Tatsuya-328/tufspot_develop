<x-template>
    <x-slot name="title"> TUFSPOT_result </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="検索結果" />
    <x-main>
        {{-- TODO: 検索ワードのスタイリングはいったんカテゴリーからとってきてる、要修正 --}}
        <div class="post_list_explain d-flex flex-column flex-md-row justify-content-around">
            <div class="text-center">
                <?php
                // 検索ワードが複数だった場合、謎空白が入らないようにphpのechoで制御
                foreach ($keywordArr as $keyword) {
                    echo '「' . $keyword . '」';
                } ?>
                を{{ config('common.search_filter')[$search_filter] === '全ての項目' ? '' : config('common.search_filter')[$search_filter] . 'に' }}含む記事
            </div>
        </div>
        <div class="article-list-area">
            <livewire:paginated-post-list :keywords="$keywordArr" :search_filter="$search_filter" page_flag="search" />
        </div>
    </x-main>
    <x-footer />
</x-template>
