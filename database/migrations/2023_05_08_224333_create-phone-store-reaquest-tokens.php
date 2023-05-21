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
        Schema::create('phone_store_request_tokens', function (Blueprint $table) {
            $table->id();

            $table->text("client_id");
            $table->text("client_secret");

            $table->text("refresh_token")->nullable();
            $table->text("code")->nullable();

            $table->string("redirect_uri");

            $table->tinyInteger('status')->default(1)->comment("0=>disable , 1=> enable");

            $table->foreignId("phone_store_id")->constrained("phone_stores")->onUpdate("cascade")->onDelete("cascade");

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
        Schema::dropIfExists('phone_store_request_tokens');
    }
};
