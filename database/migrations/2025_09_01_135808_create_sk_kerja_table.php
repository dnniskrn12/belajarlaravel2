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
        Schema::create('sk_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('no_sk')->unique();
            $table->string('no_pegawai');
            $table->string('nama_pegawai');
            $table->date('tgl_sk');

            // sesuaikan dengan tipe PK di tabel referensi
            $table->unsignedBigInteger('id_unitkerja');
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_lokasi');

            $table->timestamps();

            // foreign key
            $table->foreign('id_unitkerja')->references('id')->on('unit_kerja')->onDelete('cascade');
            $table->foreign('id_jabatan')->references('id')->on('jabatan')->onDelete('cascade');
            $table->foreign('id_lokasi')->references('id')->on('lokasi')->onDelete('cascade');
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
