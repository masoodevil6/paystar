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
        Schema::create('code_offs', function (Blueprint $table) {
            $table->id();
            $table->string("code");

            $table->string("off_price");
            $table->string("period");

            $table->string("min_price")->nullable();
            $table->string("image")->nullable();

            $table->tinyInteger('is_public')->default(0)->comment("0=>person , 1=> public");
            $table->tinyInteger('used')->default(0)->comment("0=>not used , 1=> used");
            $table->tinyInteger('status')->default(1)->comment("0=>disable , 1=> enable");

            $table->foreignId("user_id")->nullable()->constrained("users")->onUpdate("cascade")->onDelete("cascade");

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
        Schema::dropIfExists('code_offs');
    }
};
