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
    public $page_flag; // どのページを表示するのか

    // ページ遷移後、スクロールアップ
    public function updatedPage($page)
    {
        $this->dispatch('page-updated');
    }

    public function render()
    {
        // ライター詳細の記事一覧
        if ($this->page_flag === "writer_detail") {
            $posts = $this->user->posts()->paginate($this->per_page);

            // マイページの保存記事一覧
        } else if ($this->page_flag === "mypage") {
            $posts = $this->user->likes()->paginate($this->per_page);
        }
        return view('livewire.user-post-list', compact('posts'));
    }
}
