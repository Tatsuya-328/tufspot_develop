<?php

namespace App\Livewire\Back;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class EditTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $add_post_ids;

    private $per_page = 10;

    public function render()
    {
        // dd($this->add_post_ids);
        // $posts = Post::all();
        $posts = Post::paginate($this->per_page);
        return view('livewire.back.edit-table', compact('posts'));
    }
}
