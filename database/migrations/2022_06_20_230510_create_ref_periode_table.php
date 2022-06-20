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
        Schema::create('ref_periode', function (Blueprint $table) {
            $table->id();
            $table->string('semester', 4);
            $table->string('des_semester', 45);
            $table->date_create('start_date');
            $table->date_create('end_date');
            $table->enum('aktif', [0, 1])->default(0);
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
        Schema::dropIfExists('ref_periode');
    }
};
