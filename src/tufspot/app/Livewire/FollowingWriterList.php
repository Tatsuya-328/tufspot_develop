<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class FollowingWriterList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public User $user;

    public $per_page = 6;

    // ページ遷移後、スクロールアップ
    public function updatedPage($page)
    {
        $this->dispatch('page-updated');
    }

    public function render()
    {
        $following_writers = $this->user->followings()->paginate($this->per_page);
        return view('livewire.following-writer-list', compact('following_writers'));
    }
}
