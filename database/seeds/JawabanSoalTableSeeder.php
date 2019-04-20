<?php

use Illuminate\Database\Seeder;

class JawabanSoalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jawaban_soal_ujians = [
        [ 
			'jawaban'		=> '3500',
			'is_benar'		=> '0',			
			'poin'		=> '0',
			'id_soal'		=> '1',			
		],
		[ 
			'jawaban'		=> '2500',
			'is_benar'		=> '1',			
			'poin'		=> '10',
			'id_soal'		=> '1',			
		],
		[ 
			'jawaban'		=> '8900',
			'is_benar'		=> '0',			
			'poin'		=> '0',
			'id_soal'		=> '1',			
		],
		[ 
			'jawaban'		=> '250',
			'is_benar'		=> '0',			
			'poin'		=> '0',
			'id_soal'		=> '1',			
		],
		[ 
			'jawaban'		=> 'Mensyukuri',
			'is_benar'		=> '0',			
			'poin'		=> '0',
			'id_soal'		=> '2',			
		], 
		[ 
			'jawaban'		=> 'Menyukai',
			'is_benar'		=> '0',			
			'poin'		=> '0',
			'id_soal'		=> '2',			
		],
		[ 
			'jawaban'		=> 'Membenci',
			'is_benar'		=> '0',			
			'poin'		=> '0',
			'id_soal'		=> '2',			
		],
		[ 
			'jawaban'		=> 'Menyayangi',
			'is_benar'		=> '1',			
			'poin'		=> '10',
			'id_soal'		=> '2',			
		],	
		];    

		DB::table('jawaban_soal_ujians')->insert($jawaban_soal_ujians);
    }
}
