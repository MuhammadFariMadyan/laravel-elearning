<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {            
            $table->string('nisn_siswa');
            $table->string('nama_siswa');
            $table->string('email_siswa');
            $table->string('no_hp_siswa');
            $table->string('ttl_siswa';
            $table->string('jns_kelamin_siswa';   
            $table->text('alamat_siswa');
            $table->string('kelas_siswa');
            $table->string('foto_siswa');
            $table->string('status_siswa');            
            $table->timestamps();
            // foreign key
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->primary('nisn_siswa');                       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
