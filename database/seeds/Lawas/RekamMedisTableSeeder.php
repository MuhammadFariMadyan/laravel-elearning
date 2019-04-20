<?php

use Illuminate\Database\Seeder;

class RekamMedisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rediss = [
		[
			'no_redis'	=> 'RM1',
			'Anamnesia'	=> 'itulah',
			'pmrk_fisik'	=> 'tb = 165, bb=50',
			'keluhan'	=> 'sakit di bagian perut melilit',
			'diagnosa'	=> 'maag',		
			'therapy'	=> 'pijat perut yg sakit dengan kain hangat',
			'rcn_tndk_lnjt'	=> '-',
			'cat_kprawatan'	=> 'makan teratur dan puasa senin kamisobat diminum sebelum makan',
			'layanan_lain'	=> '-',
			'kode_pasien'	=> 'PSN1',
			'kode_dktr'	=> 'DKT1',
			'paraf_vld_dktr'	=> 'validasi Dr. Ane Jauhari',			
			'created_at'	=> '2017-11-11 16:00:00',
			'updated_at'	=> '2017-11-11 16:00:00'
		], 
		[
			'no_redis'	=> 'RM2',
			'Anamnesia'	=> 'anamnesia 2',
			'pmrk_fisik'	=> 'tb = 170, bb=65',
			'keluhan'	=> 'sakit kepala sebelah',
			'diagnosa'	=> 'migrain',		
			'therapy'	=> 'pijat kepala yg sakit',
			'rcn_tndk_lnjt'	=> '-',
			'cat_kprawatan'	=> 'banyak minum air hangat',
			'layanan_lain'	=> '-',
			'kode_pasien'	=> 'PSN2',
			'kode_dktr'	=> 'DKT2',
			'paraf_vld_dktr'	=> 'validasi Dr. Ana Wulandari',			
			'created_at'	=> '2017-11-11 16:00:00',
			'updated_at'	=> '2017-11-11 16:00:00'
		],
		[
			'no_redis'	=> 'RM3',
			'Anamnesia'	=> 'itulah',
			'pmrk_fisik'	=> 'tb = 170, bb=50',
			'keluhan'	=> 'gatal gatal di seluruh badan',
			'diagnosa'	=> 'schabies',		
			'therapy'	=> 'Mandi 2 x sehari',
			'rcn_tndk_lnjt'	=> '-',
			'cat_kprawatan'	=> 'oleskan salep di kuliat setelah kulit dibersihkan',
			'layanan_lain'	=> '-',
			'kode_pasien'	=> 'PSN3',
			'kode_dktr'	=> 'DKT3',
			'paraf_vld_dktr'	=> 'validasi Dr. Aji Pamungkas',			
			'created_at'	=> '2017-11-11 16:00:00',
			'updated_at'	=> '2017-11-11 16:00:00'
		]		
	];

	DB::table('tb_rekam_medis')->insert($rediss);
    }
}
