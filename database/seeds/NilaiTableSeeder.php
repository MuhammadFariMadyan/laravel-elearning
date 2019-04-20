<?php

use Illuminate\Database\Seeder;

class NilaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
        [ 
			'nisn_siswa'			=> '13312232',
			'id_nilai_tugas_siswa'	=> '1',			
			'id_nilai_ujian_siswa'	=> '1',			
			'created_at'			=> '2018-02-01 16:00:00',
			'updated_at'			=> '2018-02-01 16:00:00',			
		],
		[ 
			'nisn_siswa'			=> '13312233',
			'id_nilai_tugas_siswa'	=> '2',			
			'id_nilai_ujian_siswa'	=> '2',			
			'created_at'			=> '2018-02-01 16:00:00',
			'updated_at'			=> '2018-02-01 16:00:00',			
		] 	
		];    

		DB::table('nilai_siswas')->insert($nilai);
    }
}
