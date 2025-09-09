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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->boolean('role_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact');
            $table->string('gender');
            $table->text('address');
            $table->foreignId('country');
            $table->text('profile');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
