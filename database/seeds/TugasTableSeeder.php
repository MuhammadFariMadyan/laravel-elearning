<?php

use Illuminate\Database\Seeder;

class TugasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tugas = [
        [ 
			'judul_tugas'		=> 'Tugas Ringkasan Materi MTK 1',
			'deskripsi_tugas'	=> 'Membuat Ringkasan Materi MTK pada Pertemuan 1',			
			'kelas_tugas'		=> 'VII A',
			'waktu_tugas'		=> '1 Hari',
			'pembuat_tugas'		=> 'Rudi, A.Md.',
			'tgl_tugas'			=> '2018-02-01',
			'info_tugas'		=> 'Paling Lambat Upload Tugas hari ini',
			'status_tugas'		=> 'Aktif',
			'sms_status_tugas'	=> 'Aktif',
			'id_mapel'			=> '3',
			'created_at'		=> '2018-02-01 16:00:00',
			'updated_at'		=> '2018-02-01 16:00:00',			
		] 	
		];    

		DB::table('tugass')->insert($tugas);
    }
}
