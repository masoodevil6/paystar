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
        Schema::create('phone_messages', function (Blueprint $table) {
            $table->id();

            $table->string("code");
            $table->string("code_message");

            $table->tinyInteger('code_status')->default(0)->comment("0=>failed , 1=> success");

            $table->string('rec_id')->nullable();

            $table->string("sms_my_phone");
            $table->string("sms_target_phone");
            $table->text("sms_text");

            $table->string("service_name");
            $table->string("message_class_name");

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
        Schema::dropIfExists('phone_messages');
    }
};
