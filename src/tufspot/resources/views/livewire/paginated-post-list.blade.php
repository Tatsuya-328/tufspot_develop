{{-- ページアップ後のスクロールアップ
behaviorの値を変更すれば、挙動を変更できる --}}
<div x-data @page-updated.window="$el.scrollIntoView({behavior: 'auto'})">
    <div class="d-flex justify-content-center flex-wrap">
        @if (!empty($posts->first()))
            @foreach ($posts as $post)
                <x-post_card :post=$post />
            @endforeach
        @else
            <p class="text-center m-5 p-5">表示する記事が存在しません。</p>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
