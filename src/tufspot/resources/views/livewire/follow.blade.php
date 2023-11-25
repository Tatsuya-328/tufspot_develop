{{-- TODO: 使いまわしやすいクラス名にしたほうがいいかも --}}
<div class="writer-card-button-wrapper">
    @if ($auth_user->hasFollower($followed_user))
        <button wire:click="follow" class="writer-card-button text-center">フォローを外す</button>
    @else
        <button wire:click="follow" class="writer-card-button text-center">フォローする</button>
    @endif
</div>
