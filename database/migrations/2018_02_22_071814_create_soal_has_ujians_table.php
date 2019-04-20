<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalHasUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_has_ujians', function (Blueprint $table) {
            $table->increments('id');            
            // foreign key            
            $table->integer('id_soal')->unsigned();
            $table->foreign('id_soal')->references('id_soal')->on('soals')->onDelete('cascade');
            $table->integer('id_ujian')->unsigned();
            $table->foreign('id_ujian')->references('id_ujian')->on('ujians')->onDelete('cascade');
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
        Schema::drop('soal_has_ujians');
    }
}
