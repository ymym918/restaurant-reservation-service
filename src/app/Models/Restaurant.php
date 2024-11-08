<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
    use HasFactory;
    // 都道府県とのリレーション
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    // ジャンルとのリレーション
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // ユーザーとのリレーション
    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'restaurant_id', 'user_id')->withTimestamps();
    }
}
