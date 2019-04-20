<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiTugasSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_tugas_siswas', function (Blueprint $table) {
            $table->increments('id_nilai_tugas_siswa');
            $table->string('nilai_tugas');
            $table->timestamps();
            $table->timestamp('wkt_mulai');
            $table->timestamp('wkt_selesai');

            // foreign key  
            $table->integer('id_tugas')->unsigned();
            $table->foreign('id_tugas')->references('id_tugas')->on('tugass')->onDelete('cascade');           
            $table->string('nisn_siswa');
            $table->foreign('nisn_siswa')->references('nisn_siswa')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nilai_tugas_siswas');
    }
}
