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
        Schema::create('pend_magang', function (Blueprint $table) {
            $table->id(column: 'id_pend_mag');
            $table->string('no_magang');
            $table->unsignedBigInteger('id_jjg');
            $table->string('nama_pend', 100);
            $table->string('thn_pend',10);
            $table->timestamps();

            $table->foreign('no_magang')->references('no_magang')->on('magang')->onDelete('cascade');
            $table->foreign('id_jjg')->references('id_jjg')->on('jenjang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pend_magang');
    }
};
