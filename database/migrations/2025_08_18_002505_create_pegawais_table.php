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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('no_pegawai',15)->unique();
            $table->string('nama_pegawai');
            $table->string('tempat_lahir', 35)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('alamat')->nullable();
            $table->string('agama', 15)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 35);
            $table->enum('status_kwn', ['Menikah', 'Belum Menikah']);
            $table->enum('status_pekerjaan', ['Aktif', 'Non Aktif']);
            $table->date('tgl_masuk');
            $table->date('tgl_akhir')->nullable();
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
