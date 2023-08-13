<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheSellerDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_seller_days', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger("day_id")->nullable();
            $table->foreign("day_id")->references("id")->on("days")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("seller_place_id")->nullable();
            $table->foreign("seller_place_id")->references("id")->on("seller_place")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('the_seller_days');
    }
}
