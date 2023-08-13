<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsSmsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_sms_orders', function (Blueprint $table) {
            $table->id();

            $table->text("message_of_ads");

            $table->string("count_receivers")->nullable();
            $table->string("software_count_receivers")->default("0")->nullable();
            $table->string("software_finish")->default("no")->nullable();
            $table->string("type-ads")->nullable();
            $table->string("states")->default("pending");


            $table->unsignedBigInteger("seller_id")->nullable();;
            $table->foreign("seller_id")->references("id")->on("seller")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("seller_place_id")->nullable();;
            $table->foreign("seller_place_id")->references("id")->on("seller_place")->onDelete('cascade')->onUpdate("cascade");



            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('ads_sms_orders');
    }
}
