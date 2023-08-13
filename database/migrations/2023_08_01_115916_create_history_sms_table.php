<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorySmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_sms', function (Blueprint $table) {
            $table->id();
            $table->text("body_of_api");
            $table->text("message");



            $table->text("destinations");
            $table->string("states_of_sms");

            //used_number
            $table->unsignedBigInteger("phones_number_id")->nullable();
            $table->foreign("phones_number_id")->references("id")->on("phones_numbers")->onDelete('cascade')->onUpdate("cascade");

//            $table->unsignedBigInteger("ads_sms_order_id")->nullable();
//            $table->foreign("ads_sms_order_id")->references("id")->on("ads_sms_orders")->onDelete('cascade')->onUpdate("cascade");
//
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
        Schema::dropIfExists('history_sms');
    }
}
