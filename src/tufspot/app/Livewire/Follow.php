<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Follow extends Component
{
    public User $auth_user; // ログイン中のユーザー
    public User $followed_user; // フォローする相手

    public function mount()
    {
        $this->auth_user = Auth::user();
    }

    public function follow()
    {
        $this->auth_user->followings()->toggle($this->followed_user->id);
    }

    public function render()
    {
        return view('livewire.follow');
    }
}
