<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJawabanSoalUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_soal_ujians', function (Blueprint $table) {
            $table->increments('id_jawaban_soal_ujian');
            $table->text('jawaban');
            $table->enum('is_benar', ['1', '0'])->default('0');
            $table->integer('poin');
            $table->timestamps();
            // foreign key            
            $table->integer('id_soal')->unsigned();
            $table->foreign('id_soal')->references('id_soal')->on('soals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jawaban_soal_ujians');
    }
}
