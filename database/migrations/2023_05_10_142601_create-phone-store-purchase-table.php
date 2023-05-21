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
        Schema::create('phone_store_purchases', function (Blueprint $table) {
            $table->id();

            $table->string("sku")->nullable();

            $table->string("res_num")->nullable();

            $table->string("order_id")->nullable()->unique();
            $table->string("purchase_token")->nullable();
            $table->timestamp("purchase_time")->nullable();
            $table->tinyInteger('purchase_state')->default(-1)->comment("0=>pay , 1=> refund");
            $table->tinyInteger('consumption_state')->default(1)->comment("0=>yes consume , 1=> no consume");

            $table->string("phone")->nullable();
            $table->string("email")->nullable();

            $table->string("code_off")->nullable();
            $table->string("code_price")->nullable();

            $table->string("real_price")->nullable();
            $table->string("off_price")->nullable();
            $table->string("total_price")->nullable();

            $table->text("payload")->nullable();
            $table->text("jwt_string")->nullable();

            $table->text("last_result")->nullable()->default("");

            $table->foreignId("user_id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("subscribe_id")->constrained("subscribes")->onUpdate("cascade")->onDelete("cascade");
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
        Schema::dropIfExists('phone_store_purchases');
    }
};
