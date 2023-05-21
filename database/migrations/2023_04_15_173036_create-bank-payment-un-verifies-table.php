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
        Schema::create('bank_payment_un_verifies', function (Blueprint $table) {
            $table->id();

            $table->string("authority_num");
            $table->string("extra_data")->nullable();
            $table->string("amount");
            $table->timestamp("date_submit");

            $table->string("service_name");

            $table->tinyInteger('status')->default(0)->comment("0=>failed , 1=> success");

            $table->foreignId("user_id")->nullable()->constrained("users")->onUpdate("cascade")->onDelete("cascade");
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
        Schema::dropIfExists('bank_payment_un_verifies');
    }
};
