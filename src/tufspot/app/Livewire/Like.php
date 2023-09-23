<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Like extends Component
{
    public Post $post;
    public User $user;

    public function like()
    {
        $this->user = Auth::user();
        $this->user->likes()->toggle($this->post->id);
    }

    public function render()
    {
        return view('livewire.like');
    }
}
