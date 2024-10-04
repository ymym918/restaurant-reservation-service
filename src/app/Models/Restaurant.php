<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    // 都道府県へのリレーション
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    // ジャンルへのリレーション
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
