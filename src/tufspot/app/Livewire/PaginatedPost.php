<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedPost extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // TODO: コンポーネント名を記事一覧的な名前に変更
    // TODO: mount()内の処理がPostController内の処理と重複しているため冗長
    public $type;
    public $slug;
    public $categorySlug = null;
    public $featureSlug = null;
    public $per_page = 6; // ページ内の表示数調整

    // ページ遷移後、スクロールアップ
    public function updatedPage($page)
    {
        $this->dispatch('page-updated');
    }

    public function mount()
    {
        switch ($this->type) {
            case 'category':
                $this->categorySlug = $this->slug;
                break;
            case 'feature':
                $this->featureSlug = $this->slug;
                break;
        }
    }

    public function render()
    {
        $posts = Post::publicList(null, $this->categorySlug, $this->featureSlug)->paginate($this->per_page);
        return view('livewire.paginated-post', compact('posts'));
    }
}
