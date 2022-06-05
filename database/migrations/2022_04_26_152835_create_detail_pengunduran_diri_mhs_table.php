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
        $table->string('nim');
        $table->string('nidn');
        $table->string('keterangan_md_mhs');
        $table->string('semester_md_mhs')->nullable();
        $table->enum('status_persetujuan_pa', [2, 1, 0])->default(2);
        $table->enum('status_persetujuan_koorprodi', [2, 1, 0])->default(2);
        $table->enum('status_persetujuan_wd1', [2, 1, 0])-> default(2);
        $table->enum('status_persetujuan_wr1', [2, 1, 0])-> default(2);
        $table->enum('status_bakhum', [2, 1, 0])->default(2);
        $table->date('tanggal_pengajuan_md_mhs')->nullable();
        $table->date('tanggal_persetujuan_pa')->nullable();
        $table->date('tanggal_persetujuan_koorprodi')->nullable();
        $table->date('tanggal_persetujuan_wd1')->nullable();
        $table->date('tanggal_persetujuan_wr1')->nullable();
        $table->date('tanggal_persetujuan_bakhum')->nullable();
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
