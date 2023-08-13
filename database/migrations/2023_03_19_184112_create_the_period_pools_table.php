<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThePeriodPoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_period_pools', function (Blueprint $table) {
            $table->id();
            $table->string("price")->nullable();

            $table->unsignedBigInteger("the_period_id")->nullable();
            $table->foreign("the_period_id")->references("id")->on("the_period")->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("place_id")->nullable();
            $table->foreign("place_id")->references("id")->on("pool_place")->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('the_period_pools');
    }
}
