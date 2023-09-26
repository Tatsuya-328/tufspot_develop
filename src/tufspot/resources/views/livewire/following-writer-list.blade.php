<div x-data @page-updated.window="$el.scrollIntoView({behavior: 'auto'})">
    <div class="d-flex justify-content-center flex-wrap">
        @foreach ($following_writers as $writer)
            <x-writer_card :writer=$writer wire:key="following-writer-{{ $writer->id }}" />
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $following_writers->links() }}
    </div>
</div>
