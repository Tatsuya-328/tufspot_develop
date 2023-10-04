<?php

namespace App\Livewire\Back;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class EditTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $add_post_ids = [];
    public $all_posts;
    public $is_show_only_checked = false;

    private $per_page = 10;

    public function showOnlyChecked()
    {
        $this->is_show_only_checked = !$this->is_show_only_checked;
    }

    public function render()
    {
        if ($this->is_show_only_checked) {
            $posts = Post::whereIn('id', $this->add_post_ids)->paginate($this->per_page);
        } else {
            $posts = Post::paginate($this->per_page);
        }
        return view('livewire.back.edit-table', compact('posts'));
    }
}
