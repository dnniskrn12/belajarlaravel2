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
        Schema::create('nilai_pkl', function (Blueprint $table) {
            $table->id();
            $table->string('no_magang');
            $table->foreign('no_magang')->references('no_magang')->on('magang')->onDelete('cascade');

            $table->integer('nilai_akhir')->nullable();
            $table->text('catatan')->nullable();
            $table->string('file_scan_nilai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_pkl');
    }
};
