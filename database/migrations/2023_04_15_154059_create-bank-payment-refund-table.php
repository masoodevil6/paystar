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
        Schema::create('bank_payment_refunds', function (Blueprint $table) {
            $table->id();
            $table->string("code")->nullable();
            $table->string("message")->nullable();

            $table->string("res_num")->nullable();
            $table->string("authority_num")->nullable();
            $table->string("ref_num")->nullable();

            $table->string("mobile")->nullable();
            $table->string("email")->nullable();
            $table->string("extra_data")->nullable();

            $table->string("amount");
            $table->string("description");

            $table->string("service_name");

            $table->integer("status")->default(0)->comment("0:failed , 1:success ;  refund");

            $table->foreignId("user_id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("bank_payment_id")->nullable()->constrained("bank_payments")->onUpdate("cascade")->onDelete("cascade");
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
        Schema::dropIfExists('bank_payment_refunds');
    }
};
