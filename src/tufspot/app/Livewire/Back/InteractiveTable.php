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

    public function showOnlyChecked()
    {
        $this->is_show_only_checked = !$this->is_show_only_checked;
    }

    public function render()
    {
        if ($this->is_show_only_checked) {
            $posts = Post::whereIn('id', $this->add_post_ids)->paginate($this->per_page);

            // 選択している記事内で検索
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
