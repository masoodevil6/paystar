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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("merchant_id")->nullable();

            $table->text("access_token")->nullable()->comment("access-token for connect personal request");
            $table->string("service_name");

            $table->string("image_location")->nullable();
            $table->string("image_type")->nullable()->default(0)->comment("0:url file , 1:uploaded file ; image");
            $table->string("image_title")->nullable();
            $table->string("image_alt")->nullable();

            $table->tinyInteger('status')->default(1)->comment("0=>disable , 1=> enable");

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
        Schema::dropIfExists('banks');
    }
};
