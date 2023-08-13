<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones_numbers', function (Blueprint $table) {
            $table->id();

            $table->string("title")->default("بدون اسم")->nullable();
            $table->string("states")->default("up");
            $table->string("phone");
            $table->string("remain_messages")->default("100");
            $table->Text("token");
            $table->Text("device_id");

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
        Schema::dropIfExists('phones_numbers');
    }
}
