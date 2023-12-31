<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SnsAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'url'
    ];

    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Userのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * ユーザーID検索
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function scopeFindByUserId(Builder $query, Request $request)
    {
        // ユーザー
        if ($request->anyFilled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        return $query;
    }

    /**
     * 公開のみ表示
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublic(Builder $query)
    {
        return $query->where('is_public', true);
    }

    /**
     * 公開記事一覧取得
     *
     * @param Builder $query
     * @param string|null $tagSlug
     * @return Builder
     */
    public function scopePublicList(Builder $query, ?string $tagSlug)
    {
        if ($tagSlug) {
            $query->whereHas('tags', function($query) use ($tagSlug) {
                $query->where('slug', $tagSlug);
            });
        }
        return $query
            ->with('tags')
            ->public()
            ->latest('published_at')
            ->paginate(10);
    }

    /**
     * 公開記事をIDで取得
     *
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopePublicFindById(Builder $query, int $id)
    {
        return $query->public()->findOrFail($id);
    }

    /**
     * 全記事をIDで取得
     *
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeFindById(Builder $query, int $id)
    {
        return $query->findOrFail($id);
    }
    /**
     * 絞り込み検索
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function scopeSearch(Builder $query, Request $request)
    {
        // タイトル
        if ($request->anyFilled('title')) {
            $query->where('title', 'like', "%$request->title%");
        }
        // ユーザー
        if ($request->anyFilled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        // 公開・非公開
        if ($request->anyFilled('is_public')) {
            $query->where('is_public', $request->is_public);
        }
        // タグ
        if ($request->anyFilled('tag_id')) {
            $query->whereHas('tags', function($query) use ($request) {
                $query->where('tag_id', $request->tag_id);
            });
        }
        return $query;
    }

    /**
     * 公開日を年月日で表示
     *
     * @return string
     */
    public function getPublishedFormatAttribute()
    {
        return $this->published_at->format('Y年m月d日');
    }

    /**
     * 公開ステータスをラベル表示
     *
     * @return string
     */
    public function getIsPublicLabelAttribute()
    {
        return config('common.public_status')[$this->is_public];
    }
}
