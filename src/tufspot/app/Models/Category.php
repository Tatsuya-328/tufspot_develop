<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name', 'description', 'is_public'
    ];

    const NAME = [
        'Academia' => 1,
        'Business' => 2,
        'Culture' => 3,
    ];

    protected $casts = [
        'is_public' => 'bool',
        // 'published_at' => 'datetime'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
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
