<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'restaurant_id'];

    // Userとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Restaurantとのリレーション
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // レストランがログインユーザーにお気に入りされているかをチェック
    public static function isFavoritedBy($userId, $restaurantId)
    {
        return self::where('user_id', $userId)
            ->where('restaurant_id', $restaurantId)
            ->exists();
    }
}
