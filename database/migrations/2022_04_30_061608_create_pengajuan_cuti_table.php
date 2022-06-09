<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Faculty;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_cuti', function (Blueprint $table) {
          $table->integer('id', 11);
          $table->char('nim', 10);
          $table->text('nama');
          $table->foreignId('kode_prodi');
          $table->tinyInteger('jenis_kelamin');
          $table->foreignId('kode_fakultas');
          $table->string('no_telp', 15);
          $table->year('tahun_angkatan');
          $table->integer('semester');
          $table->text('keterangan');
          $table->integer('status_pengajuan')->default(0);
          $table->integer('jenis_pengajuan')->default(1);
          $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_cuti');
    }
};
