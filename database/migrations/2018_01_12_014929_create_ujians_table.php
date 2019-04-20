<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->increments('id_ujian');
            $table->string('jenis_ujian'); 
            $table->string('judul_ujian'); // nama ujian
            $table->string('info_ujian');  // keterangan
            $table->string('kelas_ujian');                       
            $table->string('waktu_ujian'); // batas waktu
            $table->tinyInteger('jumlah_soal');  
            $table->enum('is_random', ['1', '0'])->default('0');
            $table->string('pembuat_ujian');
            $table->date('tgl_ujian');            
            $table->string('status_ujian');            
            $table->timestamps();
            // foreign key                        
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('mata_pelajarans')->onDelete('cascade');               
             // $table->integer('id_user')->unsigned();
             // $table->foreign('id_user')->references('id_user')
             //       ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujians');
    }
}
