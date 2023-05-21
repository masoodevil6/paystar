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
        Schema::create('phone_store_tokens', function (Blueprint $table) {
            $table->id();

            $table->text("access_token");
            $table->timestamp("expired_in");

            $table->tinyInteger('status')->default(1)->comment("0=>disable , 1=> enable");

            $table->foreignId("phone_store_id")->constrained("phone_stores")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("phone_store_request_token_id")->nullable()->constrained("phone_store_request_tokens")->onUpdate("cascade")->onDelete("cascade");

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
        Schema::dropIfExists('phone_store_tokens');
    }
};
