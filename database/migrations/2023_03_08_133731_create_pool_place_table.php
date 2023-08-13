<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoolPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pool_place', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->text("location")->nullable();
            $table->string("state")->default("0")->nullable();
            $table->string("explorer")->default("0")->nullable();
            $table->string("total_pricing")->nullable();

            $table->unsignedBigInteger("owner_id")->nullable();
            $table->foreign("owner_id")->references("id")->on("owners")->onDelete('cascade')->onUpdate("cascade");


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
        Schema::dropIfExists('pool_place');
    }
}
