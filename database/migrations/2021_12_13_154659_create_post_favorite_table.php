<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_favorite', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("post_id");
            $table->timestamps();
            
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("post_id")->references("id")->on("posts")->onDelete("cascade");
            //user_idとpost_idの組み合わせの重複を許さない
            $table->unique(["user_id", "post_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_favorite');
    }
}
