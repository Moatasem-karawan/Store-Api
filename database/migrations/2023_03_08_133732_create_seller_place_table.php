<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_place', function (Blueprint $table) {
            $table->id();
            $table->string("title_of_place");
            $table->string("description_of_place");
            $table->text("time_work");
            $table->string("place_phone");
            $table->string("location")->nullable();
            $table->string("delivery_state")->nullable()->default("0");
            $table->string("total_pricing")->nullable();


            $table->string("explorer")->default("0")->nullable();
            $table->string("state")->default("0")->nullable();
            $table->unsignedBigInteger("seller_id")->nullable();
            $table->foreign("seller_id")->references("id")->on("seller")->onDelete('cascade')->onUpdate("cascade");


            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete('cascade')->onUpdate("cascade");


            $table->unsignedBigInteger("area_id");
            $table->foreign("area_id")->references("id")->on("areas")->onDelete('cascade')->onUpdate("cascade");


            $table->unsignedBigInteger("region_id");
            $table->foreign("region_id")->references("id")->on("regions")->onDelete('cascade')->onUpdate("cascade");


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
        Schema::dropIfExists('seller_place');
    }
}
