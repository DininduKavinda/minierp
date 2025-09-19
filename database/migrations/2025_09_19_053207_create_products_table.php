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
        Schema::create('products', function (Blueprint $table) {
            $table->unassignedBigInteger('user_id');

            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->double('price');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foregin('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
