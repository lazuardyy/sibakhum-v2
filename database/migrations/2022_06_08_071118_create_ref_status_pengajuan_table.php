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
        Schema::create('ref_status_pengajuan', function (Blueprint $table) {
            $table->integer('id');
            // $table->string('jenis_pengajuan', 45);
            $table->string('status_pengajuan_cuti', 45);
            $table->string('status_pengunduran_diri', 45);
            $table->string('keterangan_cuti', 255);
            $table->string('keterangan_md', 255);
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
        Schema::dropIfExists('ref_status_pengajuan');
    }
};
