<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function newQuery()
    {
        // 全ての呼び出しでリレーション
        // 親のメソッドを呼び出す。もともとはクエリビルダーを新規作成するときに呼び出されるメソッド。
        $query = parent::newQuery();
        $query = $query->with(['snsAccounts', 'gaigokaiMembers']);

        return $query;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'introduction',
        'profile_image_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        // レジスター時の２回ハッシュ原因で、ログインできていなかった
        // 保存時user_idをログインユーザーに設定
        // self::saving(function($user) {
        //     if ($user->password) {
        //         $user->password = Hash::make($user->password);
        //     }
        // });
    }

    /**
     * Postのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * SnsAccountsのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function snsAccounts()
    {
        return $this->hasMany(SnsAccount::class);
    }

    /**
     * SnsAccountsのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gaigokaiMembers()
    {
        return $this->belongsToMany(GaigokaiMember::class);
    }

    /**
     * いいねのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }

    /**
     * フォロー機能のリレーション
     * 特定のユーザーがフォローしているユーザーを取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_user_id');
    }

    /**
     * フォロー機能のリレーション
     * 特定のユーザーをフォローしているユーザーを取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'user_id');
    }

    /**
     * 権限をラベル表示
     *
     * @return string
     */
    public function getRoleLabelAttribute()
    {
        return config('common.user.roles')[$this->role];
    }
}
