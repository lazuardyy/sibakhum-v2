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
        Schema::create('ref_file_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_mhs_id');
            $table->char('nim', 10);
            $table->string('file_pengajuan_md')->nullable();
            $table->string('file_permohonan_md')->nullable();
            $table->string('file_sk')->nullable();
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
        Schema::dropIfExists('ref_file_pengajuan');
    }
};
