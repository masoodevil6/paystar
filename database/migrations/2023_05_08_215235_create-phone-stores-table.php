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
        Schema::create('phone_stores', function (Blueprint $table) {
            $table->id();

            $table->string("title");

            $table->text("rsa_key");
            $table->text("jwt_key")->nullable();

            $table->string("service_name");

            $table->string('package_name')->nullable();

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
        Schema::dropIfExists('phone_stores');
    }
};
