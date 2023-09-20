<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GaigokaiAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'phone_number', 'member_id', 
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
}
