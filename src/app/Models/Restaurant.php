<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
    use HasFactory;

    // 都道府県テーブルとのリレーション
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    // ジャンルテーブルとのリレーション
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
        // $userがnullでない場合のみお気に入り状態を確認
        return $this->favorites()->where('user_id', $user->id)->exists();

        return false; // ログインしていない場合はお気に入りではない
    }
}
