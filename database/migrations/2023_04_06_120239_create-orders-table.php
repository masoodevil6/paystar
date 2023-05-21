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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string("res_num");

            $table->string("code_off")->nullable();
            $table->integer("code_price")->default(0);

            $table->integer("real_price")->default(0);
            $table->integer("off_price")->default(0);
            $table->integer("total_Price")->default(0);

            $table->string("description_finish")->nullable()->comment("the reason for finish is true");
            $table->tinyInteger("is_finish")->default(0)->comment("0:false , 1:true ; is finish order");

            $table->foreignId("user_id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");

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
        Schema::dropIfExists('orders');
    }
};
