<?php

use Illuminate\Database\Seeder;

class DokterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $dokters = [
        [
            'kode_dktr'=>'DKT1', 'nama_dktr'=>'Ane Jauhari', 'alamat_dktr'=>'jl. Abdul Kadir gg.pipit no.135, Rajabasa, Bandarlampung', 'tgl_lahir_dktr'=>'1987-02-12', 'agama_dktr'=>'Islam', 'pend_trkhr_dktr'=>'dokter', 'telp_dktr'=>'086755846678', 'created_at'=>'2017-11-11 16:00:00', 'updated_at'=>'2017-11-11 16:00:00'
        ], 
        [
            'kode_dktr'=>'DKT2', 'nama_dktr'=>'Ana Wulandari', 'alamat_dktr'=>'jl. Abdul Kadir gg.perkutut no.35, Rajabasa, Bandarlampung', 'tgl_lahir_dktr'=>'1989-02-12', 'agama_dktr'=>'Islam', 'pend_trkhr_dktr'=>'dokter', 'telp_dktr'=>'085755846678', 'created_at'=>'2017-11-11 16:00:00', 'updated_at'=>'2017-11-11 16:00:00'
        ],
        [
            'kode_dktr'=>'DKT3', 'nama_dktr'=>'Aji Pamungkas', 'alamat_dktr'=>'jl. Abdul Kadir gg.dara no.15, Rajabasa, Bandarlampung', 'tgl_lahir_dktr'=>'1977-02-12', 'agama_dktr'=>'Islam', 'pend_trkhr_dktr'=>'dokter', 'telp_dktr'=>'084755846698', 'created_at'=>'2017-11-11 16:00:00', 'updated_at'=>'2017-11-11 16:00:00'
        ]
    ];

	// masukkan data ke database
	DB::table('tb_dokter')->insert($dokters);
    }
}
