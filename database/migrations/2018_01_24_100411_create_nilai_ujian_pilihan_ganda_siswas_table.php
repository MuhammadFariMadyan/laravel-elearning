<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiUjianPilihanGandaSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_ujian_pilgan_siswas', function (Blueprint $table) {
            $table->increments('id_nilai_ujian_pilgan');            
            $table->integer('nilai');
            $table->timestamps();
            $table->timestamp('wkt_mulai')->nullable()->change();
            $table->timestamp('wkt_selesai')->nullable()->change();
            // foreign key                
            $table->string('nisn_siswa');
            $table->foreign('nisn_siswa')->references('nisn_siswa')->on('siswas')->onDelete('cascade');      
            $table->integer('id_ujian')->unsigned();
            $table->foreign('id_ujian')->references('id_ujian')->on('ujians')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nilai_ujian_pilgan_siswas');
    }
}
