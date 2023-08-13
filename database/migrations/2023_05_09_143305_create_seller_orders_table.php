<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_orders', function (Blueprint $table) {
            $table->id();
            $table->string("order_uuid")->nullable();
            $table->string("location_description")->nullable();
            $table->string("state_pay")->nullable();

            $table->string("count_ex")->nullable(); // total count_ex * count _order  ;
            $table->string("name_ex")->nullable();
            $table->string("ex_price_order")->nullable();
            $table->string("count_product")->nullable();




            $table->string("state_order")->nullable(); // state delivary order
            $table->string("accept_order")->nullable(); // accept or not



            $table->string("price_order")->nullable();
            $table->text("state_price_order")->nullable();






            //$table->string("new_price")->nullable();


            $table->string("x")->nullable();
            $table->string("y")->nullable();


            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade')->onUpdate("cascade");


            $table->unsignedBigInteger("seller_place_id")->nullable();
            $table->foreign("seller_place_id")->references("id")->on("seller_place")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("product_seller_place_id")->nullable();
            $table->foreign("product_seller_place_id")->references("id")->on("product_seller_place")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("offer_seller_id")->nullable();
            $table->foreign("offer_seller_id")->references("id")->on("offer_seller")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("code_offer_id")->nullable();
            $table->foreign("code_offer_id")->references("id")->on("seller_codes")->onDelete('cascade')->onUpdate("cascade");



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
        Schema::dropIfExists('seller_orders');
    }
}
