<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{

    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // user_id と restaurant_id の組み合わせにユニーク制約を追加
            $table->unique(['user_id', 'restaurant_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
