<?php

use Illuminate\Database\Seeder;

class UjianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ujian = [
        [ 
			'jenis_ujian'		=> 'Ujian Harian',
			'judul_ujian'		=> 'Ujian MTK 1',			
			'kelas_ujian'		=> 'VII A',
			'waktu_ujian'		=> '60',
			'jumlah_soal'		=> '20',
			'is_random'			=> '0',
			'pembuat_ujian'		=> 'Rudi, A.Md.',
			'tgl_ujian'			=> '2018-03-03',
			'info_ujian'		=> 'Dikerjakan Sekarang Juga',
			'status_ujian'		=> 'Aktif',						
			'created_at'		=> '2018-03-03 16:00:00',
			'updated_at'		=> '2018-03-03 16:00:00',		
			'id_mapel'			=> '3',
		],
		[ 
			'jenis_ujian'		=> 'Ujian MID',
			'judul_ujian'		=> 'Ujian MTK MID',			
			'kelas_ujian'		=> 'VII A',
			'waktu_ujian'		=> '120',
			'jumlah_soal'		=> '20',
			'is_random'			=> '1',
			'pembuat_ujian'		=> 'Rudi, A.Md.',
			'tgl_ujian'			=> '2018-03-03',
			'info_ujian'		=> 'Dikerjakan Sekarang Juga',
			'status_ujian'		=> 'Aktif',						
			'created_at'		=> '2018-03-03 16:00:00',
			'updated_at'		=> '2018-03-03 16:00:00',		
			'id_mapel'			=> '3',
		] 	
		];    

		DB::table('ujians')->insert($ujian);
    }
}
