<?php

use Illuminate\Database\Seeder;

class SoalUjianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $soals = [
        [ 
			'jenis_soal'		=> 'Pilihan Ganda',
			'pertanyaan'		=> '<p>Berapakah hasil perkalian antara 50 x 50 ?</p>',			
			'gambar'		=> '',
			'id_ujian'		=> '1',			
		],
		[ 
			'jenis_soal'		=> 'Pilihan Ganda',
			'pertanyaan'		=> '<p>Fari <strong><em>Mencintai</em></strong> Ibunya Sebagai Seorang Anak yang Berbakti. Kata yang bercetak tebal dan bergaris miring memiliki maksud ?</p>',			
			'gambar'		=> '',
			'id_ujian'		=> '1',
		] 	
		];    

		DB::table('soals')->insert($soals);
    }
}
