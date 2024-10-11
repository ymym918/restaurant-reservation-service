<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'reservation_date',
        'reservation_time',
        'number_of_people',
    ];

    // 関連付け: ユーザー
    public function user() {
        return $this->belongsTo(User::class);
    }

    // 関連付け: レストラン
    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
}
