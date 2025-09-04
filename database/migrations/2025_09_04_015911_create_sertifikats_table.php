<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nilai_pkl')->unique();
            $table->string('nomor_sertifikat')->nullable();
            $table->date('tanggal_sertifikat')->nullable();
            $table->string('file_sertifikat')->nullable();

            $table->foreign('id_nilai_pkl')->references('id')->on('nilai_pkl')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sertifikat');
    }
};
