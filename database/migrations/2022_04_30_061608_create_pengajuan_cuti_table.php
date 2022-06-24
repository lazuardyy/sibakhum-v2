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
        Schema::create('pengajuan_mhs', function (Blueprint $table) {
          $table->integer('id', 11);
          $table->char('nim', 10);
          $table->char('pa', 15);
          $table->text('nama');
          $table->tinyInteger('jenis_kelamin');
          $table->string('nama_prodi');
          $table->foreignId('kode_prodi');
          $table->string('nama_fakultas');
          $table->foreignId('kode_fakultas');
          $table->string('email')->unique();
          $table->string('no_telp', 15);
          $table->year('tahun_angkatan');
          $table->integer('semester');
          $table->text('keterangan');
          $table->integer('status_pengajuan')->default(0);
          $table->integer('jenis_pengajuan')->default(1);
          $table->string('no_surat')->nullable();
          $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_mhs');
    }
};
