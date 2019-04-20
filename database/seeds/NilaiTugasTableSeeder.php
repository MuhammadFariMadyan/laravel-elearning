<?php

use Illuminate\Database\Seeder;

class NilaiTugasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai_tugas = [
        [ 
			'nisn_siswa'	=> '13312232',
			'id_tugas'		=> '1',			
			'id_mapel'		=> '1',			
			'nilai_tugas'	=> '80',		
			'created_at'	=> '2018-02-01 16:00:00',
			'updated_at'	=> '2018-02-01 16:00:00',			
		],
		[ 
			'nisn_siswa'	=> '13312233',
			'id_tugas'		=> '1',			
			'id_mapel'		=> '1',			
			'nilai_tugas'	=> '99',		
			'created_at'	=> '2018-02-01 16:00:00',
			'updated_at'	=> '2018-02-01 16:00:00',			
		] 	
		];    

		DB::table('nilai_tugas_siswas')->insert($nilai_tugas);
    }
}
