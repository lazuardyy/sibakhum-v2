<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengunduran_diri_mhs', function (Blueprint $table) {
          $table->id();
          $table->foreignId('nim');
          $table->foreignId('kodeProdi');
          $table->string('keterangan_md_mhs');
          $table->string('semester_md_mhs');
          $table->enum('status_persetujuan_pa', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
          $table->enum('status_persetujuan_koorprodi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
          $table->enum('status_persetujuan_wd1', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
          $table->enum('status_persetujuan_wr1', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
          $table->enum('status_bakhum', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
          $table->date('tanggal_pengajuan_md_mhs');
          $table->date('tanggal_persetujuan_pa');
          $table->date('tanggal_persetujuan_koorprodi');
          $table->date('tanggal_persetujuan_wd1');
          $table->date('tanggal_persetujuan_wr1');
          $table->date('tanggal_persetujuan_bakhum');
          $table->binary('file_pengajuan_md')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengunduran_diri_mhs');
    }
};
