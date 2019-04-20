<?php

use Illuminate\Database\Seeder;

class NilaiUjianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai_ujian = [
        [ 
			'nisn_siswa'	=> '13312232',						
			'nilai_ujian'	=> '100',		
			'created_at'	=> '2018-02-01 16:00:00',
			'updated_at'	=> '2018-02-01 16:00:00',			
		],
		[ 
			'nisn_siswa'	=> '13312233',					
			'nilai_ujian'	=> '90',		
			'created_at'	=> '2018-02-01 16:00:00',
			'updated_at'	=> '2018-02-01 16:00:00',			
		] 	
		];    

		DB::table('nilai_ujian_siswas')->insert($nilai_ujian);
    }
}
