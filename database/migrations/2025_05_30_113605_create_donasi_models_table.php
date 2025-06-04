<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('donasi_models', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('whatsapp');
            $table->integer('nominal');
            $table->string('metode_pembayaran')->nullable();
            $table->text('pesan')->nullable();
            $table->string('order_id')->unique();
            $table->string('status')->default();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_models');
    }
};
