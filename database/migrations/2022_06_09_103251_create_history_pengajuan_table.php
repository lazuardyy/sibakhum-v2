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
        Schema::create('history_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengajuan');
            $table->integer('jenis_pengajuan');
            $table->integer('v_mode');
            $table->integer('status_pengajuan')->default(0);
            $table->tinyText('alasan')->nullable();
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
        Schema::dropIfExists('history_pengajuan');
    }
};
