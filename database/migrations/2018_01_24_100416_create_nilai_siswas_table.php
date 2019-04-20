<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_siswas', function (Blueprint $table) {
            $table->increments('id_nilai_siswa');            
            $table->timestamps();

            // foreign key            
            $table->string('nisn_siswa');
            $table->foreign('nisn_siswa')->references('nisn_siswa')->on('siswas')->onDelete('cascade');
            $table->integer('id_nilai_tugas_siswa')->unsigned();
            $table->foreign('id_nilai_tugas_siswa')->references('id_nilai_tugas_siswa')->on('nilai_tugas_siswas')->onDelete('cascade');                        
            $table->integer('id_nilai_ujian_siswa')->unsigned();
            $table->foreign('id_nilai_ujian_siswa')->references('id_nilai_ujian_siswa')->on('nilai_ujian_siswas')->onDelete('cascade');                        
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_siswas');
    }
}
