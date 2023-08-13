<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferPoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_pool', function (Blueprint $table) {
            $table->id();
            $table->string("new_price");
            $table->string("state");
            $table->unsignedBigInteger("the_period_pool_id")->nullable();
            $table->foreign("the_period_pool_id")->references("id")->on("the_period_pools")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("pool_place_id")->nullable();
            $table->foreign("pool_place_id")->references("id")->on("pool_place")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('offer_pool');
    }
}
