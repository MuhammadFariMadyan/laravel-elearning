<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaJawabTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_jawab_tugas', function (Blueprint $table) {
            $table->increments('id_siswa_jawab_tugas');
            $table->text('jawaban_tugas');
            $table->string('nama_file_jawaban_tugas');
            $table->timestamps();
            // foreign key  
            $table->integer('id_tugas')->unsigned();
            $table->foreign('id_tugas')->references('id_tugas')->on('tugass')->onDelete('cascade');
            $table->string('nisn_siswa');
            $table->foreign('nisn_siswa')->references('nisn_siswa')->on('siswas')->onDelete('cascade');
            $table->integer('id_nilai_tugas_siswa')->unsigned();
            $table->foreign('id_nilai_tugas_siswa')->references('id_nilai_tugas_siswa')->on('nilai_tugas_siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('siswa_jawab_tugas');
    }
}
