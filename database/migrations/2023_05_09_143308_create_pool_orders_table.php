<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoolOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pool_orders', function (Blueprint $table) {
            $table->id();
            $table->string("order_uuid")->nullable();

            $table->string("number_of_persons")->nullable();

            $table->string("state_pay")->nullable();
            $table->string("state_pool_order")->nullable();

            $table->string("price_order")->nullable();
            $table->text("state_price_order")->nullable();


            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade')->onUpdate("cascade");


            $table->unsignedBigInteger("pool_place_id")->nullable();
            $table->foreign("pool_place_id")->references("id")->on("pool_place")->onDelete('cascade')->onUpdate("cascade");

            $table->date("date_reservation")->nullable();

            $table->unsignedBigInteger("the_period_id")->nullable();
            $table->foreign("the_period_id")->references("id")->on("the_period")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("offer_pool_id")->nullable();
            $table->foreign("offer_pool_id")->references("id")->on("offer_pool")->onDelete('cascade')->onUpdate("cascade");
            $table->unsignedBigInteger("code_offer_id")->nullable();
            $table->foreign("code_offer_id")->references("id")->on("pool_codes")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('pool_orders');
    }
}
