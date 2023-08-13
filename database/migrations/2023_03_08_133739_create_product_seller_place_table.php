<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSellerPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_seller_place', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->string("price")->nullable();

            $table->string('count_ex')->nullable();
            $table->string('name_ex')->nullable();

            $table->string("ex_price")->nullable();


            $table->string("state")->nullable()->default("0");


            $table->unsignedBigInteger("seller_id")->nullable();;
            $table->foreign("seller_id")->references("id")->on("seller")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("seller_place_id")->nullable();;
            $table->foreign("seller_place_id")->references("id")->on("seller_place")->onDelete('cascade')->onUpdate("cascade");



            $table->unsignedBigInteger("sub_category_seller")->nullable();
            $table->foreign("sub_category_seller")->references("id")->on("sub_category_seller")->onDelete('cascade')->onUpdate("cascade");




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
        Schema::dropIfExists('product_seller_place');
    }
}
