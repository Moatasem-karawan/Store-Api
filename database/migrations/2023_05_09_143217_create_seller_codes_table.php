<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_codes', function (Blueprint $table) {
            $table->id();
            $table->string("code")->unique();

            $table->string("max_use");

            $table->string("usage")->default("0");
            $table->string("state")->default("1");

            $table->string("offer");

            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete('cascade')->onUpdate("cascade");


            $table->unsignedBigInteger("seller_place_id")->nullable();
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
        Schema::dropIfExists('seller_codes');
    }
}
