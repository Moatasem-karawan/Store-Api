<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategorySellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_category_seller', function (Blueprint $table) {
            $table->id();
            $table->string("title");


            $table->unsignedBigInteger("seller_id")->nullable();;
            $table->foreign("seller_id")->references("id")->on("seller")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("seller_place_id")->nullable();;
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
        Schema::dropIfExists('sub_category_seller');
    }
}
