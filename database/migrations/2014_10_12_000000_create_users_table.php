<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('family')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->timestamp('mobile_verified_at')->nullable();

            $table->string('password');
            $table->text('profile_photo_path')->nullable()->comment("avatar");
            $table->tinyInteger('activation')->default(0)->comment("0=>disable , 1=>enable , for register client ");
            $table->timestamp('activation_time')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0=>disable , 1=> enable , for disable client for site");

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
