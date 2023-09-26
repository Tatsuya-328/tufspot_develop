<div x-data @page-updated.window="$el.scrollIntoView({behavior: 'auto'})">
    <div class="d-flex flex-wrap flex-column justify-content-center align-content-center">
        @foreach ($writers as $writer)
            <x-writer_explain :writer=$writer />
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $writers->links() }}
    </div>
</div>
