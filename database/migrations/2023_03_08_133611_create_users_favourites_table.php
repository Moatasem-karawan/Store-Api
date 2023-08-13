<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void piviot table
     */
    public function up()
    {
        Schema::create('users_favourites', function (Blueprint $table) {
            $table->id();
            $table->text("comment")->nullable();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");


            $table->unsignedBigInteger("favourites_id");
            $table->foreign("favourites_id")->references("id")->on("favourites");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_favourites');
    }
}
