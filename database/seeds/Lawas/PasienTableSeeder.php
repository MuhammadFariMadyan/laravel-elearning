<?php

use Illuminate\Database\Seeder;

class PasienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pasiens = [
		['kode_pasien'=>'PSN1','nama_pasien'=>'Diana','alamat'=>'jl. Abdul Kadir gg.pipit no.124 Rajabasa Bandarlampung','rt'=>'02','rw'=>'03','tgl_lahir'	=> '1992-02-12', 'agama'=>'Islam','jen_pmbyrn'=>'bpjs','no_jaminan'=>'101992021200135',	'pekerjaan'=>'PNS',	'pend_trkhr'=>'Sarjana S1',	'telp'=>'085768365584',	'ortu_suami'=>'Suami Adit',	'istri_anak'=>'Anak Dani',	'alergi_obat'=>'-',	'created_at'=>'2017-11-11 16:00:00', 'updated_at'=>'2017-11-11 16:00:00'],
		['kode_pasien'=>'PSN2','nama_pasien'=>'Andi','alamat'=>'jl. Abdul Kadir gg.pipit no.34 Rajabasa Bandarlampung','rt'=>'02','rw'=>'03','tgl_lahir'	=> '1992-10-12', 'agama'=>'Islam','jen_pmbyrn'=>'bpjs','no_jaminan'=>'101992021200133',	'pekerjaan'=>'Wiraswasta',	'pend_trkhr'=>'Sarjana S1',	'telp'=>'085768365577',	'ortu_suami'=>'Ortu Deni',	'istri_anak'=>'Istri Sinta',	'alergi_obat'=>'-',	'created_at'=>'2017-11-11 16:00:00', 'updated_at'=>'2017-11-11 16:00:00'],
		['kode_pasien'=>'PSN3','nama_pasien'=>'Doni','alamat'=>'jl. Kucing gg.Rajawali no.78 Rajabasa Bandarlampung','rt'=>'01','rw'=>'02','tgl_lahir'	=> '1988-10-12', 'agama'=>'Islam','jen_pmbyrn'=>'bpjs','no_jaminan'=>'101992021200773',	'pekerjaan'=>'Programmer',	'pend_trkhr'=>'Sarjana S1',	'telp'=>'083768365577',	'ortu_suami'=>'Ortu Deni',	'istri_anak'=>'Istri Indah',	'alergi_obat'=>'-',	'created_at'=>'2017-11-11 16:00:00', 'updated_at'=>'2017-11-11 16:00:00']

	];

	// masukkan data ke database
	DB::table('tb_pasien')->insert($pasiens);
    }
}
