<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavebyUserPoolPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saveby_user_pool_place', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pool_place_id")->nullable();
            $table->foreign("pool_place_id")->references("id")->on("pool_place")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('saveby_user_pool_place');
    }
}
