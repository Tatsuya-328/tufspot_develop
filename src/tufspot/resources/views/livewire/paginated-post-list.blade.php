{{-- ページアップ後のスクロールアップ
behaviorの値を変更すれば、挙動を変更できる --}}
<div x-data @page-updated.window="$el.scrollIntoView({behavior: 'auto'})">
    <div class="d-flex justify-content-center flex-wrap">
        @foreach ($posts as $post)
            <x-post_card :post=$post />
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
