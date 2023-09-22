@props(['class' => '', 'listTitle' => ''])

<div class="post_list_title {{ $class }}">
    <x-bread />
    <div class="post_list_title_content">
        <p class="post_list_title_text m-0">{{ $listTitle }}</p>
    </div>
</div>
