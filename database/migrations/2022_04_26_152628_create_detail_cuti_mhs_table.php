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
        Schema::create('detail_cuti_mhs', function (Blueprint $table) {
          $table->id();
          $table->foreignId('nim');
          $table->foreignId('nidn');
          // $table->string('keterangan_cuti_mhs');
          $table->string('semester_cuti_mhs');
          $table->enum('status_persetujuan_pa', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
          $table->enum('status_persetujuan_koorprodi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
          $table->enum('status_persetujuan_wd1', ['menunggu', 'disetujui', 'ditolak'])-> default('menunggu');
          $table->enum('status_persetujuan_wr1', ['menunggu', 'disetujui', 'ditolak'])-> default('menunggu');
          $table->enum('status_bakhum', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
          $table->date('tanggal_pengajuan_cuti_mhs')->nullable();
          $table->date('tanggal_persetujuan_pa')->nullable();
          $table->date('tanggal_persetujuan_koorprodi')->nullable();
          $table->date('tanggal_persetujuan_wd1')->nullable();
          $table->date('tanggal_persetujuan_wr1')->nullable();
          $table->date('tanggal_persetujuan_bakhum')->nullable();
          $table->binary('file_pengajuan_cuti')->nullable();
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
        Schema::dropIfExists('detail_cuti_mhs');
    }
};
