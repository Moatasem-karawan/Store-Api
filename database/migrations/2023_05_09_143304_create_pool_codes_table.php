<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoolCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pool_codes', function (Blueprint $table) {
            $table->id();
            $table->string("code")->unique();

            $table->string("max_use");

            $table->string("usage")->default("0");
            $table->string("state")->default("1");

            $table->string("offer");

            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("pool_place_id")->nullable();
            $table->foreign("pool_place_id")->references("id")->on("pool_place")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('pool_codes');
    }
}
