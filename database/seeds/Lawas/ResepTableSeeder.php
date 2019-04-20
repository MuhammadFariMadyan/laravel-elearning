<?php

use Illuminate\Database\Seeder;

class ResepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reseps = [
		[
			'no_resep'	=> 'RSP1',
			'resep'	=> 'milanta',
			'tgl_resep'	=> '2017-11-11',
			'no_redis'	=> 'RM1',
			'created_at'	=> '2017-11-11 16:00:00',
			'updated_at'	=> '2017-11-11 16:00:00',
		],
		[
			'no_resep'	=> 'RSP2',
			'resep'	=> 'Oskadon',
			'tgl_resep'	=> '2017-11-12',
			'no_redis'	=> 'RM2',
			'created_at'	=> '2017-11-11 16:00:00',
			'updated_at'	=> '2017-11-11 16:00:00',
		],
		[
			'no_resep'	=> 'RSP3',
			'resep'	=> 'Antangin',
			'tgl_resep'	=> '2017-12-11',
			'no_redis'	=> 'RM3',
			'created_at'	=> '2017-11-11 16:00:00',
			'updated_at'	=> '2017-11-11 16:00:00',
		]	
		];    

		DB::table('tb_resep')->insert($reseps);
	}
}
