<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitorings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('skpd_id')
                  ->constrained('skpds')
                  ->onDelete('cascade');

            $table->foreignId('pj_skpd_id')
                  ->constrained('pj_skpds')
                  ->onDelete('cascade');

            $table->string('status');

            $table->date('tanggal_update');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};