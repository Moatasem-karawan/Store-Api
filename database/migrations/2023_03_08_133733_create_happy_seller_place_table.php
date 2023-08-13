<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHappySellerPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('happy_seller_place', function (Blueprint $table) {
            $table->id();
            $table->string("title_of_place");
            $table->string("description_of_place");
            $table->string("time_work");
            $table->string("place_phone");
            $table->string("location")->nullable();
            $table->string("explorer")->default("0")->nullable();;
            $table->string("state")->default("0")->nullable();
            $table->unsignedBigInteger("happy_seller_id")->nullable();;
            $table->foreign("happy_seller_id")->references("id")->on("happy_owner")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('happy_seller_place');
    }
}
