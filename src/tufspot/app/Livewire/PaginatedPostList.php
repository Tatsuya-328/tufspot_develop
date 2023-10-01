<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedPostList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // カテゴリー詳細ページ用プロパティ
    public $type;
    public $slug;
    public $categorySlug = null;
    public $featureSlug = null;

    // 検索結果表示用
    public $keywords;

    // ハッシュタグ検索結果表示用
    public $tag_slug;

    public User $user;
    public $per_page = 6; // ページ内の表示数調整
    public $page_flag; // どのページを表示するのか、コンポーネントを使いまわすために利用

    // ページ遷移後、スクロールアップ
    public function updatedPage($page)
    {
        $this->dispatch('page-updated');
    }

    public function mount()
    {
        // カテゴリー詳細ページのみ実行
        if ($this->page_flag === "category_detail") {
            switch ($this->type) {
                case 'category':
                    $this->categorySlug = $this->slug;
                    break;
                case 'feature':
                    $this->featureSlug = $this->slug;
                    break;
            }
        }
    }

    public function render()
    {
        // カテゴリー詳細ページ
        if ($this->page_flag === "category_detail") {
            $posts = Post::publicList(null, $this->categorySlug, $this->featureSlug)->paginate($this->per_page);
        }

        // ライター詳細の記事一覧
        if ($this->page_flag === "writer_detail") {
            $posts = $this->user->posts()->paginate($this->per_page);
        }

        // マイページの保存記事一覧
        if ($this->page_flag === "mypage") {
            $posts = $this->user->likes()->paginate($this->per_page);
        }

        // 検索結果一覧
        if ($this->page_flag === "search") {
            $query = Post::query();

            foreach ($this->keywords as $keyword) {
                $query->orWhere('title', 'like', "%{$keyword}%")->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('body', 'like', "%{$keyword}%")
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
            }

            $posts = $query->paginate($this->per_page);
        }

        // ハッシュタグ検索一覧
        if ($this->page_flag === "hashtag") {
            $posts = Post::whereHas('tags', function ($q) {
                $q->where('slug', $this->tag_slug);
            })->paginate($this->per_page);
        }

        return view('livewire.paginated-post-list', compact('posts'));
    }
}
