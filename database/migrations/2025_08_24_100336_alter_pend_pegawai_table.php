<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop existing foreign keys
        Schema::table('pend_pegawai', function (Blueprint $table) {
            $table->dropForeign(['no_pegawai']);
            $table->dropForeign(['id_jjg']);
        });

        // Modify no_pegawai to string and fix foreign key
        Schema::table('pend_pegawai', function (Blueprint $table) {
            $table->string('no_pegawai', 15)->change();
            $table->foreign('no_pegawai')->references('no_pegawai')->on('pegawai')->onDelete('cascade');
            $table->foreign('id_jjg')->references('id_jjg')->on('jenjang');
        });
    }

    public function down(): void
    {
        Schema::table('pend_pegawai', function (Blueprint $table) {
            $table->dropForeign(['no_pegawai']);
            $table->dropForeign(['id_jjg']);
            $table->unsignedBigInteger('no_pegawai')->change();
            $table->foreign('no_pegawai')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreign('id_jjg')->references('id_jjg')->on('jenjang');
        });
    }
};
