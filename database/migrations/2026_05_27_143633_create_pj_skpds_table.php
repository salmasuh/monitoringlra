<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pj_skpds', function (Blueprint $table) {

            $table->id();

            $table->string('nama');

            $table->string('nip')->nullable();

            $table->foreignId('skpd_id')
                  ->constrained('skpds')
                  ->onDelete('cascade');

            $table->string('no_hp')->nullable();

            $table->string('email')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pj_skpds');
    }
};