<div class="writer-card d-flex flex-wrap flex-column align-content-center" wire:key="writer-{{ $writer->id }}">
    <a href="{{ route('writer_detail', ['user' => $writer['tufspot_id']]) }}" class="text-decoration-none">
        <div class="d-flex flex-wrap flex-column justify-content-center align-content-center">
            @if ($writer['profile_image_path'])
                <img loading="lazy" src="{{ $writer['profile_image_path'] }}" class="" alt="{{ $writer['name'] }} のプロフィール画像" style="height: 100px; width: 100px;" />
            @else
                <svg class="d-inline text-secondary" xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
            @endif
        </div>
        <p class="writer-card-name text-center">
            {{ $writer['name'] }}
        </p>
    </a>
    @if (!$writer->isAuthUser())
        <livewire:follow :followed_user=$writer wire:key="follow-button-{{ $writer->id }}" />
    @endif
</div>
