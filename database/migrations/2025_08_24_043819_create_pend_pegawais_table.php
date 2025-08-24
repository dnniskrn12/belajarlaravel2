<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pend_pegawai', function (Blueprint $table) {
            $table->id(column: 'id_pend_pgw');
            $table->unsignedBigInteger('no_pegawai'); // relasi ke pegawai
            $table->unsignedBigInteger('id_jjg'); // relasi ke jenjang
            $table->string('nama_pend', 100); // contoh: Universitas Andalas
            $table->year('thn_pend'); // tahun lulus
            $table->timestamps();

            $table->foreign('no_pegawai')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreign('id_jjg')->references('id_jjg')->on('jenjang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pend__pegawai');
    }
};
