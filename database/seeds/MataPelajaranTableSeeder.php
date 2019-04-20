<?php

use Illuminate\Database\Seeder;

class MataPelajaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mata_pelajarans = [
        [ 	
        	'nip_guru'		=> "111",		
			'nama_mapel'		=> 'Ilmu Pengetahuan Alam',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> "111",
			'nama_mapel'		=> 'Ilmu Pengetahuan Sosial',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> "111",
			'nama_mapel'		=> 'Matematika',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> "111",
			'nama_mapel'		=> 'Bina Lingkungan',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> "111",
			'nama_mapel'		=> 'Bahasa Indonesia',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> '111',
			'nama_mapel'		=> 'Bahasa Inggris',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> '111',
			'nama_mapel'		=> 'Bahasa Lampung',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> '111',
			'nama_mapel'		=> 'PPKN',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> '111',
			'nama_mapel'		=> 'Agama',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> '111',
			'nama_mapel'		=> 'Komputer',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> '111',
			'nama_mapel'		=> 'KTK',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		],
		[ 
			'nip_guru'		=> '111',
			'nama_mapel'		=> 'Orkes',			
			'created_at'		=> '2018-01-28 16:00:00',
			'updated_at'		=> '2018-01-28 16:00:00',			
		]	
		];    

		DB::table('mata_pelajarans')->insert($mata_pelajarans);
    }
}
