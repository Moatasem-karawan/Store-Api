<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferSellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_seller', function (Blueprint $table) {
            $table->id();
            $table->string("new_price_product");

            $table->string("count_ex")->nullable();
            $table->string("name_ex")->nullable();


            $table->string("ex_price")->nullable();
            $table->string("state");
            $table->unsignedBigInteger("seller_place_id")->nullable();
            $table->foreign("seller_place_id")->references("id")->on("seller_place")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("product_seller_place_id")->nullable();
            $table->foreign("product_seller_place_id")->references("id")->on("product_seller_place")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('offer_seller');
    }
}
