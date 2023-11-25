<div x-data @page-updated.window="$el.scrollIntoView({behavior: 'auto'})">
    <div class="d-flex justify-content-center flex-wrap">
        @if (!empty($following_writers->first()))
            @foreach ($following_writers as $writer)
                <x-writer_card :writer=$writer />
            @endforeach
        @else
            <p class="text-center m-5 p-5">フォロー済みライターが存在しません。</p>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        {{ $following_writers->links() }}
    </div>
</div>
