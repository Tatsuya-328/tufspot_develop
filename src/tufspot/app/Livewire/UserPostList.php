<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserPostList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public User $user;
    public $per_page = 6; // ページ内の表示数調整

    // ページ遷移後、スクロールアップ
    public function updatedPage($page)
    {
        $this->dispatch('page-updated');
    }

    public function render()
    {
        $posts = $this->user->posts()->paginate(6);
        return view('livewire.user-post-list', compact('posts'));
    }
}
