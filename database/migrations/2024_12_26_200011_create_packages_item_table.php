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
        Schema::create('packages_item', function (Blueprint $table) {
            $table->id();
            $table->string('chave_nfe');
            $table->char('status', length: 100);

            $table->unsignedBigInteger('packages_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('packages_id')->references('id')->on('packages');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages_item');
    }
};
