<div class="writer-card d-flex flex-wrap flex-column align-content-center">
    <a href="{{ route('writer_detail', ['user' => $writer['id']]) }}" class="text-decoration-none">
        <div class="d-flex flex-wrap flex-column justify-content-center align-content-center">
            {{-- TODO: アイコン画像表示 --}}
            <img src="{{ asset('image/fox_circle.png') }}" style="width:100px; height:100px;" class="" alt="...">
        </div>
        <p class="writer-card-name text-center">
            {{ $writer['name'] }}
        </p>
    </a>
    @if (Auth::id() != $writer->id)
        <livewire:follow :followed_user=$writer />
    @endif
</div>
