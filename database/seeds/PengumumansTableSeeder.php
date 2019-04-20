<?php

use Illuminate\Database\Seeder;

class PengumumansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengumumans = [
		[
			'judul'	=> 'Sosialisai E-Learning',
			'deskripsi'	=> 'Diumumkan kepada Seluruh Siswa kelas IX A agar mengikuti acara Sosialisasi E-Learnig pada :
							Hari : Senin
							Pukul : 09.00 s.d Selesai
							Ruangan : Aula 
							Terima Kasih atas partisipasinya.',
			'author'	=> 'Rudi, A.Md.',			
			'created_at'	=> '2018-01-12 16:00:00',
			'updated_at'	=> '2018-01-12 16:00:00',			
		],
		[
			'judul'	=> 'Rapat Komite',
			'deskripsi'	=> 'Diumumkan kepada Seluruh Orang Tua / Wali dari Siswa kelas IX A agar menikuti acara Rapat Komite pada :
							Hari : Rabu
							Pukul : 09.00 s.d Selesai
							Ruangan : Aula 
							Terima Kasih atas partisipasinya.',
			'author'	=> 'Rudi, A.Md.',			
			'created_at'	=> '2018-01-12 16:00:00',
			'updated_at'	=> '2018-01-12 16:00:00',			
		]	
		];
		DB::table('pengumumans')->insert($pengumumans);
    }
}
