{{-- Academy等のカテゴリと、〇〇特集、どちらにも使える詳細ページ --}}
<x-template>
    <x-slot name="title"> TUFSPOT_category_detail </x-slot>
    <x-header />
    <x-post_list_title listTitle="{{ $category->name }}" />
    <x-main>
        {{-- <x-post_list_explain /> --}}
        <div class="post_list_explain d-flex flex-column justify-content-center">
            <p class="post_list_explain_text m-0">
                {!! nl2br($category->description) !!}
            </p>
        </div>
        <div class="article-list-area">
            <livewire:paginated-post-list :type="$type" :slug="$slug" page_flag="category_detail" />
        </div>
    </x-main>
    <x-footer />
</x-template>
