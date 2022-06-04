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
        Schema::create('students', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('detailCutiMhs_id');
            // $table->foreignId('dosen_id');
            $table->bigIncrements('nim')->unique();
            $table->text('nama');
            $table->foreignId('kodeProdi');
            $table->tinyInteger('jenis_kelamin');
            $table->foreignId('kodeFakultas');
            $table->string('no_telp', 15);
            $table->year('tahun_angkatan');
            $table->text('keterangan');
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
        Schema::dropIfExists('students');
    }
};
