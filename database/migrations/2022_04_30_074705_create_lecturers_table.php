<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;
use App\Models\DetailCutiMhs;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
          // $table->string('nidn', 15)->unique();
          // $table->foreignIdFor(Student::class);
          // $table->foreignIdfor(DetailCutiMhs::class);
            // $table->id();
            $table->bigIncrements('nidn');
            // $table->foreignId('id_siakad');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_telp', 15);
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
        Schema::dropIfExists('lecturers');
    }
};
