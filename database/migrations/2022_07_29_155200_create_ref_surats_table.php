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
        Schema::create('ref_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_mhs_id');
            $table->char('nim', 10);
            $table->string('no_surat_prodi')->nullable();
            $table->string('no_surat_fakultas')->nullable();
            $table->string('no_surat_bakhum')->nullable();
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
        Schema::dropIfExists('ref_surat');
    }
};
