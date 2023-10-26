<div class="writer-card d-flex flex-wrap flex-column align-content-center" wire:key="writer-{{ $writer->id }}">
    <a href="{{ route('writer_detail', ['user' => $writer['id']]) }}" class="text-decoration-none">
        <div class="d-flex flex-wrap flex-column justify-content-center align-content-center">
            <img loading="lazy" src="{{ $writer['profile_image_path'] ?? asset('image/fox_circle.png') }}" style="width: 26px; height: 26px;" class="" alt="{{ $writer['name'] }} のプロフィール画像" />
        </div>
        <p class="writer-card-name text-center">
            {{ $writer['name'] }}
        </p>
    </a>
    @if (!$writer->isAuthUser())
        <livewire:follow :followed_user=$writer wire:key="follow-button-{{ $writer->id }}" />
    @endif
</div>
