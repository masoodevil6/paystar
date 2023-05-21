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
        Schema::create('order_baskets', function (Blueprint $table) {
            $table->id();

            $table->string("order_basketable_type");
            $table->bigInteger("order_basketable_id");
            $table->string("cookie")->nullable()->comment("cookie is token basket");

            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->string("price")->nullable();
            $table->string("off")->nullable();

            $table->integer("submitted")->default(0)->comment("0:not submitted , 1:submitted ;  payment");

            $table->foreignId("order_id")->nullable()->constrained("orders")->onUpdate("cascade")->onDelete("cascade");

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
        Schema::dropIfExists('order_baskets');
    }
};
