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

    public function updatedPage($page)
    {
        $following_user_count = $this->user->followings()->count();

        // 今の件数が、次のページを持つべきでない場合
        if (
            $following_user_count <=
            $this->per_page * ($page - 1)
        ) {
            $this->resetPage();
        }

        // ページ遷移後、スクロールアップ
        $this->dispatch('page-updated');
    }

    public function render()
    {
        $following_writers = $this->user->followings()->paginate($this->per_page);
        return view('livewire.following-writer-list', compact('following_writers'));
    }
}
