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
        Schema::create('study_programs', function (Blueprint $table) {
          $table->foreignId('kode_fakultas');
          $table->bigIncrements('kode_prodi');
          $table->text('nama_prodi');
          $table->text('jenjang');
          // $table->string('nidn');
          // $table->text('jabatan');
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
        Schema::dropIfExists('study_programs');
    }
};
