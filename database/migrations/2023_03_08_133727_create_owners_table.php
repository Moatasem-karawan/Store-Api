<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('re_password')->nullable();
            $table->string("daily_sms")->default("0")->nullable();
            $table->string("weekly")->default("0")->nullable();
            $table->string("Monthly_sms")->default("0")->nullable();

            $table->string("daily_notification")->default("0")->nullable();
            $table->string("weekly_notification")->default("0")->nullable();
            $table->string("Monthly__notification")->default("0")->nullable();

            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete('cascade')->onUpdate("cascade");

            $table->rememberToken();

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
        Schema::dropIfExists('owners');
    }
}
