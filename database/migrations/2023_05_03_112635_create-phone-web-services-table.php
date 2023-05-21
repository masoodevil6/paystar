<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_web_services', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("user_name");

            $table->string("password");
            $table->string("phone_number");

            $table->string("service_name");
            $table->string("message_class_name");

            $table->string('link_panel')->nullable();

            $table->tinyInteger('status')->default(0)->comment("0=>failed , 1=> success");

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
        Schema::dropIfExists('phone_web_services');
    }
};
