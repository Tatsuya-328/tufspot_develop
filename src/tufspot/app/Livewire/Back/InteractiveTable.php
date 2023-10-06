<?php

namespace App\Livewire\Back;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class InteractiveTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $add_post_ids = [];
    public $all_posts;
    public $is_show_only_checked = false;
    public $keyword = '';

    private $per_page = 10;

    public function updatedKeyword()
    {
        // 検索後は1ページ目に戻る
        $this->resetPage();
    }

    public function updatedIsShowOnlyChecked()
    {
        // 選択済みのみに表示を切り替える場合は1ページ目に戻る
        $this->resetPage();
    }

    public function updatedAddPostIds()
    {
        // 選択中のみ表示している時に、3ページあるとする
        // 3ページ目のチェックを全て外す時、2ページ目に戻らなければいけない
        // 以下で対応
        if ($this->is_show_only_checked) {
            $checked_post_count = count($this->add_post_ids);
            if ($checked_post_count <= $this->per_page * ($this->paginators['page'] - 1)) {
                $this->setPage($this->paginators['page'] - 1);
            }
        }
    }

    public function render()
    {
        if ($this->is_show_only_checked) {
            $posts = Post::whereIn('id', $this->add_post_ids)->paginate($this->per_page);

            // 選択している記事内で検索
            // 選択済み表示と項目検索はAND検索
            if ($this->keyword) {
                $posts = Post::where('title', 'like', "%{$this->keyword}%")->whereIn('id', $this->add_post_ids)->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', "%{$this->keyword}%");
                })->whereIn('id', $this->add_post_ids)->paginate($this->per_page);
            }
        } else {
            $posts = Post::paginate($this->per_page);

            // 全ての記事内で検索
            if ($this->keyword) {
                $posts = Post::where('title', 'like', "%{$this->keyword}%")->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', "%{$this->keyword}%");
                })->paginate($this->per_page);
            }
        }

        return view('livewire.back.interactive-table', compact('posts'));
    }
}
