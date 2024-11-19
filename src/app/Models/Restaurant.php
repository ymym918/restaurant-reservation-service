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

    // お気に入りとのリレーション
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

    // area検索(ローカルスコープ)
    public function scopePrefectureSearch($query, $prefecture)
    {
        if ($prefecture) {
            return $query->whereHas('prefecture', function ($q) use ($prefecture) {
                $q->where('name', $prefecture);
            });
        }
    }

    // genre検索(ローカルスコープ)
    public function scopeGenreSearch($query, $genre)
    {
        if ($genre) {
            return $query->whereHas('genre', function ($q) use ($genre) {
                $q->where('name', $genre);
            });
        }
    }

    // キーワード検索(ローカルスコープ)
    public function scopeKeywordSearch($query, $keyword)
    {
        if ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        }
    }
}
