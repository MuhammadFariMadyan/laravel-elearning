<?php

use Illuminate\Database\Seeder;

class GurusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  //       $gurus = [
  //       [ 
		// 	'nip_guru'		=> '111',
		// 	'nama_guru'		=> 'Eva Susanti, S.E',
		// 	'ttl_guru'			=> 'Bandung, 26 Mei 1995',
		// 	'jns_kelamin_guru'	=> 'Perempuan',
		// 	'agama_guru'	=> 'Islam',
		// 	'no_telp_guru'		=> '081279098909',
		// 	'email_guru'		=> 'ida@gmail.com',									
		// 	'alamat_guru'		=> 'Sukarame Perum Korpri',
		// 	'jabatan_guru'		=> 'Guru Ilmu Pengetahuan Sosial',
		// 	'foto_guru'		=> 'TI-ANISA RIZKI AMALIA.JPG',
		// 	'status_guru'		=> 'Aktif',
		// 	'id_user'			=> '2',
		// 	'created_at'		=> '2018-01-28 16:00:00',
		// 	'updated_at'		=> '2018-01-28 16:00:00',			
		// ],
		// [ 
		// 	'nip_guru'		=> '12321',
		// 	'nama_guru'		=> 'Aida Fatia',
		// 	'ttl_guru'			=> 'Bandung, 26 Mei 1995',
		// 	'jns_kelamin_guru'	=> 'Perempuan',
		// 	'agama_guru'	=> 'Islam',
		// 	'no_telp_guru'		=> '081279098909',
		// 	'email_guru'		=> 'ida@gmail.com',									
		// 	'alamat_guru'		=> 'Sukarame Perum Korpri',
		// 	'jabatan_guru'		=> 'Guru Ilmu Pengetahuan Alam',
		// 	'foto_guru'		=> 'TI-AINI RAHMAYATI.JPG',
		// 	'status_guru'		=> 'Aktif',
		// 	'id_user'			=> '2',
		// 	'created_at'		=> '2018-01-28 16:00:00',
		// 	'updated_at'		=> '2018-01-28 16:00:00',			
		// ],
		// [ 
		// 	'nip_guru'		=> '12342',
		// 	'nama_guru'		=> 'Indri Roviroli, S.Pd',
		// 	'ttl_guru'			=> 'Bandung, 26 Mei 1995',
		// 	'jns_kelamin_guru'	=> 'Perempuan',
		// 	'agama_guru'	=> 'Islam',
		// 	'no_telp_guru'		=> '081279098909',
		// 	'email_guru'		=> 'ida@gmail.com',									
		// 	'alamat_guru'		=> 'Sukarame Perum Korpri',
		// 	'jabatan_guru'		=> 'Guru Matematika',
		// 	'foto_guru'		=> 'TI-ATEK FITRIANI RASYID.JPG',
		// 	'status_guru'		=> 'Aktif',
		// 	'id_user'			=> '2',
		// 	'created_at'		=> '2018-01-28 16:00:00',
		// 	'updated_at'		=> '2018-01-28 16:00:00',			
		// ],
		// [ 
		// 	'nip_guru'		=> '123456',
		// 	'nama_guru'		=> 'Roaida, A.Md',
		// 	'ttl_guru'			=> 'Bandung, 26 Mei 1995',
		// 	'jns_kelamin_guru'	=> 'Perempuan',
		// 	'agama_guru'	=> 'Islam',
		// 	'no_telp_guru'		=> '081279098909',
		// 	'email_guru'		=> 'ida@gmail.com',									
		// 	'alamat_guru'		=> 'Sukarame Perum Korpri',
		// 	'jabatan_guru'		=> 'Guru Bahasa Indonesia',
		// 	'foto_guru'		=> 'TI-ENDAH YUSHAIRANI.JPG',
		// 	'status_guru'		=> 'Aktif',
		// 	'id_user'			=> '2',
		// 	'created_at'		=> '2018-01-28 16:00:00',
		// 	'updated_at'		=> '2018-01-28 16:00:00',			
		// ]	
		// ]; 

		$gurus = [
        [ 
			'nip_guru'		=> '111',
			'nama_guru'		=> 'Eva Susanti, S.E',
			'ttl_guru'			=> 'Bandung, 26 Mei 1995',
			'jns_kelamin_guru'	=> 'Perempuan',
			'agama_guru'	=> 'Islam',
			'no_telp_guru'		=> '081279098909',
			'email_guru'		=> 'ida@gmail.com',									
			'alamat_guru'		=> 'Sukarame Perum Korpri',
			'jabatan_guru'		=> 'Guru Ilmu Pengetahuan Sosial',
			'foto_guru'		=> 'TI-ANISA RIZKI AMALIA.JPG',
			'status_guru'		=> 'Aktif',
			'id_user'			=> '2',
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		] 	
		];   

		DB::table('gurus')->insert($gurus);
    }
}
