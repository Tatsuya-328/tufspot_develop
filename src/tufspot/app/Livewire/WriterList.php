<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class WriterList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // TODO: シーダー流して動作確認
    public $per_page = 1;

    // ページ遷移後、スクロールアップ
    public function updatedPage($page)
    {
        $this->dispatch('page-updated');
    }

    public function render()
    {
        // 管理者かつ記事を持っている(公開)ユーザーのみ表示
        $public = 1;
        $writers = User::where([
            ['role', '=', 1],
        ])->with(['posts' => function ($query) use ($public) {
            $query->where('is_public', $public);
        }])->whereHas('posts', function ($query) {
            $query->whereExists(function ($query) {
                return $query;
            });
        })->paginate($this->per_page);

        return view('livewire.writer-list', compact('writers'));
    }
}
