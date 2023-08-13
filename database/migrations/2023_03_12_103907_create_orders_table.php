<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("order_uuid")->nullable();
            $table->string("name_person");
            $table->string("state_paying");

            $table->string("from")->nullable();
            $table->string("to")->nullable();
            $table->date("day")->nullable();



//            $table->unsignedBigInteger("period_id")->nullable();
//            $table->foreign("period_id")->references("id")->on("period")->onDelete('cascade')->onUpdate("cascade");


            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");


            $table->unsignedBigInteger("category_id")->nullable();
            $table->foreign("category_id")->references("id")->on("categories");


//            $table->unsignedBigInteger("product_id")->nullable();
//            $table->foreign("product_id")->references("id")->on("products");



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
        Schema::dropIfExists('orders');
    }
}
