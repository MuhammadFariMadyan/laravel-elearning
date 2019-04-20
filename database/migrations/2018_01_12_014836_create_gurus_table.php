<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {            
            $table->string('nip_guru');
            $table->string('nama_guru');
            $table->text('ttl_guru');
            $table->string('jns_kelamin_guru');
            $table->string('agama_guru');
            $table->string('no_telp_guru');
            $table->string('email_guru');
            $table->string('alamat_guru');
            $table->string('jabatan_guru');
            $table->string('foto_guru');
            $table->string('status_guru');
            $table->timestamps(); 
            // foreign key
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');   
            $table->primary('nip_guru');               
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
}
