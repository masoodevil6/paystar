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
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("sku")->nullable();

            $table->text("description")->nullable();
            $table->string("slug")->unique()->nullable();

            $table->integer("real_price")->nullable();
            $table->integer("off_price")->nullable();
            $table->integer("duration")->nullable();

            $table->tinyInteger('status')->default(1)->comment("0=>disable , 1=> enable");
            $table->tinyInteger('selected')->default(0)->comment("0=>not selected , 1=> selected :for slider");

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
        Schema::dropIfExists('subscribes');
    }
};
