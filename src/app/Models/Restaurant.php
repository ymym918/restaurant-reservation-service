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

    // favoriteとのリレーション
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // お気に入り登録されているかを確認するメソッド
    public function isFavoritedBy($user)
    {
        // $userがnullでない場合にのみuser_idを参照
        return $user ? $this->favorites()->where('user_id', $user->id)->exists() : false;
    }

    // エリア(prefecture)検索スコープ
    public function scopePrefecture($query, $prefecture)
    {
        return $query->where('prefecture', $prefecture);
    }

    // ジャンル(genre)検索スコープ
    public function scopeGenre($query, $genre)
    {
        return $query->where('genre', $genre);
    }
}
