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
    <div class="writer-card-button-wrapper">
        <a href="#" class="writer-card-button text-center">フォローを外す</a>
    </div>

</div>
