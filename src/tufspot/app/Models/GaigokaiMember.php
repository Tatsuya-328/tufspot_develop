<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GaigokaiMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number', 'member_id', 
    ];

    // 主キーカラム名を指定
    // protected $primaryKey = 'member_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Userのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
