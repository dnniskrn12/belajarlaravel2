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
        Schema::create('sk_magang', function (Blueprint $table) {
            $table->id();
            $table->string('no_sk')->unique();
            $table->string('no_magang');
            $table->string('nama_siswa');
            $table->date('tgl_sk');

            // sesuaikan dengan tipe PK di tabel referensi
            $table->unsignedBigInteger('id_unitmagang');
            $table->timestamps();

            // foreign key
            $table->foreign('id_unitmagang')->references('id')->on('unit_magang')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_kerja');
    }
};
