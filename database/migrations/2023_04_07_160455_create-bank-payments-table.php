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
        Schema::create('bank_payments', function (Blueprint $table) {
            $table->id();
            $table->string("code")->nullable();
            $table->string("message")->nullable();

            $table->string("Res_num")->nullable();
            $table->string("authority_num")->nullable();
            $table->string("ref_num")->nullable();

            $table->string("mobile")->nullable();
            $table->string("email")->nullable();
            $table->string("extra_data")->nullable();

            $table->string("amount")->nullable();
            $table->string("description")->nullable();

            $table->string("service_name");

            $table->text("text_admin")->nullable()->comment("mark text for admin");

            $table->tinyInteger("active")->default(1)->comment("0:not active , 1:active ; for verify");
            $table->tinyInteger("is_test")->default(0)->comment("0:false , 1:true ; type payment");
            $table->tinyInteger("is_status")->default(0)->comment("0:false , 1:true ; status payment");

            $table->foreignId("user_id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");

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
        Schema::dropIfExists('bank_payments');
    }
};
