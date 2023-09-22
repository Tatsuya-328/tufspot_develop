<x-template>
    <x-slot name="title"> TUFSPOT_writer </x-slot>
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="ライター一覧" />
    <x-main>
        <div class="d-flex flex-wrap flex-column justify-content-center align-content-center">
            @foreach ($writers as $writer)
                <x-writer_explain :writer=$writer />
            @endforeach
            {{-- <x-writer_explain />
            <x-writer_explain />
            <x-writer_explain /> --}}
        </div>
    </x-main>
    <x-footer />
</x-template>
