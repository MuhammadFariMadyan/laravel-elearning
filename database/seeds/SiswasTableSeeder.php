<?php

use Illuminate\Database\Seeder;

class SiswasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $siswas = [
        [ 
			'nisn_siswa'		=> '13312233',
			'nama_siswa'		=> 'Muhammad Arman Sayekti ',
			'email_siswa'		=> 'sayekti@gmail.com',
			'no_hp_siswa'		=> '082176074036',
			'ttl_siswa'			=> 'Bandung, 26 Mei 1995',
			'jns_kelamin_siswa'	=> 'Laki - laki',
			'alamat_siswa'		=> 'Sukarame Perum Korpri',
			'kelas_siswa'		=> 'IX A',
			'foto_siswa'		=> 'foto .jpg',
			'status_siswa'		=> 'Aktif',
			'id_user'			=> '3',
			'created_at'		=> '2018-01-11 16:00:00',
			'updated_at'		=> '2018-01-11 16:00:00',			
		],
		[ 
			'nisn_siswa'		=> '13312232',
			'nama_siswa'		=> 'Ahmad Salsabil',
			'email_siswa'		=> 'Salsabil@gmail.com',
			'no_hp_siswa'		=> '081215869294',
			'ttl_siswa'			=> 'Padang, 34 Juli 1995',
			'jns_kelamin_siswa'	=> 'Laki - laki',
			'alamat_siswa'		=> 'Kavling Raya Pramuka',
			'kelas_siswa'		=> 'IX A',
			'foto_siswa'		=> 'user1-128x128.jpg',
			'status_siswa'		=> 'Aktif',
			'id_user'			=> '4',
			'created_at'		=> '2018-01-11 16:00:00',
			'updated_at'		=> '2018-01-11 16:00:00',			
		]		
		];    

		DB::table('siswas')->insert($siswas);
    }
}
