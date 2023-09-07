@props(['class' => '', 'listTitle' => ''])

<div class="article_list_title {{ $class }}">
    <x-bread />
    <div class="article_list_title_content">
        <p class="article_list_title_text m-0">{{ $listTitle }}</p>
    </div>
</div>
