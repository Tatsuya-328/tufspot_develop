<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body', 'description', 'is_public', 'published_at', 'featured_image_path', 'user_id', 'update_user_id'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function newQuery()
    {
        // 全ての呼び出しでリレーション
        // 親のメソッドを呼び出す。もともとはクエリビルダーを新規作成するときに呼び出されるメソッド。
        $query = parent::newQuery();
        $query = $query->with(['user', 'tags', 'categories', 'features']);

        return $query;
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     // 保存時user_idをログインユーザーに設定
    //     self::saving(function ($post) {
    //         $post->user_id = \Auth::id();
    //     });
    // }

    /**
     * Userのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Userのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updateUser()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    /**
     * いいねのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    /**
     * 閲覧履歴のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function histories()
    {
        return $this->belongsToMany(User::class, 'histories', 'post_id', 'user_id');
    }

    /**
     * 予約投稿のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reservationPost()
    {
        return $this->hasOne(ReservationPost::class);
    }

    /**
     * 公開のみ表示
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublic(Builder $query)
    {
        return $query->where('is_public', "1");
    }

    /**
     * 公開記事一覧取得
     *
     * @param Builder $query
     * @param string|null $tagSlug
     * @return Builder
     */
    public function scopePublicList(Builder $query, ?string $tagSlug, ?string $categorySlug, ?string $featureSlug)
    {
        if ($tagSlug) {
            $query->whereHas('tags', function ($query) use ($tagSlug) {
                $query->where('slug', $tagSlug);
            });
        }
        if ($categorySlug) {
            $query->whereHas('categories', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }
        if ($featureSlug) {
            $query->whereHas('features', function ($query) use ($featureSlug) {
                $query->where('slug', $featureSlug);
            });
        }
        return $query
            ->public()
            ->latest('published_at');
        // ->paginate(10);
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
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where('tag_id', $request->tag_id);
            });
        }
        return $query;
    }

    /**
     * カテゴリー・特集取得
     *
     * @param Builder $query
     * @param Array $ids
     * @return Builder
     */
    public function scopeSearchByArray(Builder $query, array $ids)
    {
        // // タイトル
        // if (!empty($ids['title'])) {
        //     $query->where('title', 'like', "%$ids->title%");
        // }
        // // ユーザー
        // if (!empty($ids['user_id'])) {
        //     $query->where('user_id', $ids->user_id);
        // }
        // // 公開・非公開
        // if (!empty($ids['is_public'])) {
        //     $query->where('is_public', $ids->is_public);
        // }
        // // タグ
        // if (!empty($ids['tag_id'])) {
        //     $query->whereHas('tags', function ($query) use ($ids) {
        //         $query->where('tag_id', $ids->tag_id);
        //     });
        // }
        // カテゴリー
        if (!empty($ids['category_id'])) {
            $query->whereHas('categories', function ($query) use ($ids) {
                $query->where('category_id', $ids['category_id']);
            });
        }
        // カテゴリー
        if (!empty($ids['feature_id'])) {
            $query->whereHas('features', function ($query) use ($ids) {
                $query->where('feature_id', $ids['feature_id']);
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

    /**
     * いいね判定
     *
     * @return bool
     */
    public function isLiked()
    {
        $userList = $this->likes()->pluck('user_id');
        return $userList->contains(Auth::id());
    }
}
