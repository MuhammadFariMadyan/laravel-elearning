<?php

use Illuminate\Database\Seeder;

class RujukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rujuks = [
		['no_surat_rujukan'	=> 'RJK1',		
		'tgl_rujuk'	=> '2017-11-11',
		'no_redis'	=> 'RM1',
		'created_at'	=> '2017-11-11 16:00:00',
		'updated_at'	=> '2017-11-11 16:00:00'],
		['no_surat_rujukan'	=> 'RJK2',		
		'tgl_rujuk'	=> '2017-11-12',
		'no_redis'	=> 'RM2',
		'created_at'	=> '2017-11-11 16:00:00',
		'updated_at'	=> '2017-11-11 16:00:00'],
		['no_surat_rujukan'	=> 'RJK3',		
		'tgl_rujuk'	=> '2017-12-11',
		'no_redis'	=> 'RM3',
		'created_at'	=> '2017-11-11 16:00:00',
		'updated_at'	=> '2017-11-11 16:00:00']
	];

	DB::table('tb_rujuk')->insert($rujuks);
    }
}
