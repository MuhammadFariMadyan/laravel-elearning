<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function()    
{
	//Route::auth();
	// Authentication Routes...
	$this->get('login', 'Auth\AuthController@showLoginForm');
	$this->post('login', 'Auth\AuthController@login'); // method "post" dari form login
	Route::get('/', array('as'=>'admin', 'uses'=> 'AdminController@index'));
	$this->get('logout', 'Auth\AuthController@logout');
	
});

//Route as admin
Route::group(['middleware' => ['web','auth','level:11']], function()    
{	
	// Pengumuman 
	Route::get('admin/pengumuman',array('as'=>'admin.pengumuman', 'uses'=> 'Admin\PengumumanController@index'));
	Route::get('admin/tambahpengumuman', array('as'=>'admin.tambahpengumuman.show', 'uses'=> 'Admin\PengumumanController@showTambahPengumuman'));
	Route::post('admin/pengumuman/tambah', array('as'=>'admin.tambahpengumuman', 'uses'=> 'Admin\PengumumanController@tambah'));
	Route::get('admin/pengumuman/{id}/hapus', array('as'=>'admin.hapuspengumuman', 'uses'=> 'Admin\PengumumanController@hapus'));
	Route::get('admin/pengumuman/{id}/edit', array('as'=>'admin.editpengumuman', 'uses'=> 'Admin\PengumumanController@editpengumuman'));
	Route::put('admin/pengumuman/{id}/simpanedit', array('as'=>'admin.pengumuman.simpanedit', 'uses'=> 'Admin\PengumumanController@simpanedit'));

	// Kelas
	Route::get('admin/kelas',array('as'=>'admin.kelas', 'uses'=> 'Admin\KelasController@index'));
	Route::get('admin/tambahkelas', array('as'=>'admin.tambahkelas.show', 'uses'=> 'Admin\KelasController@showTambahKelas'));
	Route::post('admin/kelas/tambah', array('as'=>'admin.tambahkelas', 'uses'=> 'Admin\KelasController@tambah'));
	Route::get('admin/kelas/{id}/hapus', array('as'=>'admin.hapuskelas', 'uses'=> 'Admin\KelasController@hapus'));
	Route::get('admin/kelas/{id}/edit', array('as'=>'admin.editkelas', 'uses'=> 'Admin\KelasController@editkelas'));
	Route::put('admin/kelas/{id}/simpanedit', array('as'=>'admin.kelas.simpanedit', 'uses'=> 'Admin\KelasController@simpanedit'));

	// Siswa
	Route::get('admin/siswa',array('as'=>'admin.siswa', 'uses'=> 'Admin\SiswaController@index'));
	Route::get('admin/tambahsiswa', array('as'=>'admin.tambahsiswa.show', 'uses'=> 'Admin\SiswaController@showTambahSiswa'));
	Route::post('admin/siswa/tambah', array('as'=>'admin.tambahsiswa', 'uses'=> 'Admin\SiswaController@tambah'));
	Route::get('admin/siswa/{id}/hapus', array('as'=>'admin.hapussiswa', 'uses'=> 'Admin\SiswaController@hapus'));
	Route::get('admin/siswa/{id}/edit', array('as'=>'admin.editsiswa', 'uses'=> 'Admin\SiswaController@editsiswa'));
	Route::put('admin/siswa/{id}/simpanedit', array('as'=>'admin.siswa.simpanedit', 'uses'=> 'Admin\SiswaController@simpanedit'));
	Route::get('admin/siswa/{id}/detail', array('as'=>'admin.detailsiswa', 'uses'=> 'Admin\SiswaController@detail'));

	// Guru
	Route::get('admin/guru',array('as'=>'admin.guru', 'uses'=> 'Admin\GuruController@index'));
	Route::get('admin/tambahguru', array('as'=>'admin.tambahguru.show', 'uses'=> 'Admin\GuruController@showTambahGuru'));
	Route::post('admin/guru/tambah', array('as'=>'admin.tambahguru', 'uses'=> 'Admin\GuruController@tambah'));
	Route::get('admin/guru/{id}/hapus', array('as'=>'admin.hapusguru', 'uses'=> 'Admin\GuruController@hapus'));
	Route::get('admin/guru/{id}/edit', array('as'=>'admin.editguru', 'uses'=> 'Admin\GuruController@editguru'));
	Route::put('admin/guru/{id}/simpanedit', array('as'=>'admin.guru.simpanedit', 'uses'=> 'Admin\GuruController@simpanedit'));
	Route::get('admin/guru/{id}/detail', array('as'=>'admin.detail', 'uses'=> 'Admin\GuruController@detail'));

	// Mata Pelajaran 
	Route::get('admin/mapel',array('as'=>'admin.mapel', 'uses'=> 'Admin\MataPelajaranController@index'));
	Route::get('admin/tambahmapel', array('as'=>'admin.tambahmapel.show', 'uses'=> 'Admin\MataPelajaranController@showTambahMataPelajaran'));
	Route::post('admin/mapel/tambah', array('as'=>'admin.tambahmapel', 'uses'=> 'Admin\MataPelajaranController@tambah'));
	Route::get('admin/mapel/{id}/hapus', array('as'=>'admin.hapusmapel', 'uses'=> 'Admin\MataPelajaranController@hapus'));
	Route::get('admin/mapel/{id}/edit', array('as'=>'admin.editmapel', 'uses'=> 'Admin\MataPelajaranController@editmapel'));
	Route::put('admin/mapel/{id}/simpanedit', array('as'=>'admin.mapel.simpanedit', 'uses'=> 'Admin\MataPelajaranController@simpanedit'));

	// Materi Ajar 
	Route::get('admin/materi_ajar',array('as'=>'admin.materi_ajar', 'uses'=> 'Admin\MateriAjarController@index'));
	Route::get('admin/tambahmateri_ajar', array('as'=>'admin.tambahmateri_ajar.show', 'uses'=> 'Admin\MateriAjarController@showTambahMateriAjar'));
	Route::post('admin/materi_ajar/tambah', array('as'=>'admin.tambahmateri_ajar', 'uses'=> 'Admin\MateriAjarController@tambah'));
	Route::get('admin/materi_ajar/{id}/hapus', array('as'=>'admin.hapusmateri_ajar', 'uses'=> 'Admin\MateriAjarController@hapus'));
	Route::get('admin/materi_ajar/{id}/edit', array('as'=>'admin.editmateri_ajar', 'uses'=> 'Admin\MateriAjarController@editmateri_ajar'));
	Route::put('admin/materi_ajar/{id}/simpanedit', array('as'=>'admin.materi_ajar.simpanedit', 'uses'=> 'Admin\MateriAjarController@simpanedit'));
	Route::get('admin/materi_ajar/{id}/download', array('as'=>'admin.download_materi_ajar', 'uses'=> 'Admin\MateriAjarController@download'));

	// Tugas 
	Route::get('admin/tugas',array('as'=>'admin.tugas', 'uses'=> 'Admin\TugasController@index'));
	Route::get('admin/tambahtugas', array('as'=>'admin.tambahtugas.show', 'uses'=> 'Admin\TugasController@showTambahTugas'));
	Route::post('admin/tugas/tambah', array('as'=>'admin.tambahtugas', 'uses'=> 'Admin\TugasController@tambah'));
	Route::get('admin/tugas/{id}/hapus', array('as'=>'admin.hapustugas', 'uses'=> 'Admin\TugasController@hapus'));
	Route::get('admin/tugas/{id}/edit', array('as'=>'admin.edittugas', 'uses'=> 'Admin\TugasController@edittugas'));
	Route::put('admin/tugas/{id}/simpanedit', array('as'=>'admin.tugas.simpanedit', 'uses'=> 'Admin\TugasController@simpanedit'));		
	Route::get('admin/tugas/{id}/peserta_koreksi', array('as'=>'admin.peserta_koreksi', 'uses'=> 'Admin\TugasController@ShowPesertaKoreksiTugas'));
	Route::put('admin/tugas/siswa/{id}/update_nilai_tugas', array('as'=>'admin.peserta_koreksi', 'uses'=> 'Admin\TugasController@updateNilaiTugasSiswa'));
	// Download Tugas Siswa
	Route::get('admin/tugas/{id}/download_tugas_siswa', array('as'=>'admin.download_tugas', 'uses'=> 'Admin\TugasController@download_tugas_siswa'));

	// Ujian 
	Route::get('admin/ujian',array('as'=>'admin.ujian', 'uses'=> 'Admin\UjianController@index'));
	Route::get('admin/tambahujian', array('as'=>'admin.tambahujian.show', 'uses'=> 'Admin\UjianController@showTambahUjian'));
	Route::post('admin/ujian/tambah', array('as'=>'admin.tambahujian', 'uses'=> 'Admin\UjianController@tambah'));
	Route::get('admin/ujian/{id}/hapus', array('as'=>'admin.hapusujian', 'uses'=> 'Admin\UjianController@hapus'));
	Route::get('admin/ujian/{id}/edit', array('as'=>'admin.editujian', 'uses'=> 'Admin\UjianController@editujian'));
	Route::put('admin/ujian/{id}/simpanedit', array('as'=>'admin.ujian.simpanedit', 'uses'=> 'Admin\UjianController@simpanedit'));
	Route::get('admin/ujian/{id}/detail', array('as'=>'admin.detail_ujian', 'uses'=> 'Admin\UjianController@detail'));
	Route::get('admin/ujian_siswa/{id}/hapus', array('as'=>'admin.hapus_ujian_siswa', 'uses'=> 'Admin\UjianController@destroy'));
	Route::get('admin/siswa_ujian/{id}', array('as'=>'admin.siswa_ujian.show', 'uses'=> 'Admin\SiswaJawabUjianController@show'));
	Route::get('admin/ujian/{id}', array('as'=>'.ujian.show', 'uses'=> 'Admin\UjianController@show'));

	// Soal Ujian 
	Route::get('admin/soal_ujian',array('as'=>'admin.soal_ujian', 'uses'=> 'Admin\SoalUjianController@index'));
	Route::get('admin/tambah_soal_ujian', array('as'=>'admin.tambah_soal_ujian.show', 'uses'=> 'Admin\SoalUjianController@showTambahSoalUjian'));
	Route::post('admin/soal_ujian/tambah', array('as'=>'admin.tambah_soal_ujian', 'uses'=> 'Admin\SoalUjianController@tambah'));
	Route::get('admin/soal_ujian/{id}/hapus', array('as'=>'admin.hapusujian', 'uses'=> 'Admin\SoalUjianController@hapus'));
	Route::get('admin/soal_ujian/{id}/edit', array('as'=>'admin.editujian', 'uses'=> 'Admin\SoalUjianController@edit'));
	Route::put('admin/soal_ujian/{id}/simpanedit', array('as'=>'admin.soal_ujian.simpanedit', 'uses'=> 'Admin\SoalUjianController@simpanedit'));
	Route::get('admin/soal_ujian/{id}/detail', array('as'=>'admin.detail_soal_ujian', 'uses'=> 'Admin\SoalUjianController@detail'));
	
	// Show Nilai by Kelas
	Route::get('admin/nilai_siswa', array('as'=>'admin.nilai_siswa.kelas.mapel', 'uses'=>'Admin\NilaiController@showKelasNilai'));
	Route::post('admin/nilai_siswa', array('as'=>'admin.nilai_siswa.kelas.mapel', 'uses'=>'Admin\NilaiController@showKelasNilai'));

	Route::get('admin/nilai_ujian',array('as'=>'admin.nilai_ujian', 'uses'=> 'Admin\NilaiUjianController@index'));
	Route::get('admin/tambahnilai_ujian', array('as'=>'admin.tambahnilai_ujian.show', 'uses'=> 'Admin\NilaiUjianController@showTambahNilaiUjian'));
	Route::post('admin/nilai_ujian/tambah', array('as'=>'admin.tambahnilai_ujian', 'uses'=> 'Admin\NilaiUjianController@tambah'));
	Route::get('admin/nilai_ujian/{id}/hapus', array('as'=>'admin.hapusnilai_ujian', 'uses'=> 'Admin\NilaiUjianController@hapus'));
	Route::get('admin/nilai_ujian/{id}/edit', array('as'=>'admin.editnilai_ujian', 'uses'=> 'Admin\NilaiUjianController@editnilai_ujian'));
	Route::put('admin/nilai_ujian/{id}/simpanedit', array('as'=>'admin.nilai_ujian.simpanedit', 'uses'=> 'Admin\NilaiUjianController@simpanedit'));

	// Menu Tambahan : SMS 
	Route::get('admin/message/send',array('as'=>'admin.message.form', 'uses'=> 'Admin\MessageController@form'));		
	Route::post('admin/message/send', array('as'=>'admin.message.send', 'uses'=> 'Admin\MessageController@kirimPesan'));	
	Route::post('admin/message/sending', array('as'=>'admin.message.sendEditedMessage', 'uses'=> 'Admin\MessageController@kirimPesanEdit'));
	Route::get('admin/message/send/{id}/edit', array('as'=>'admin.message_edit.send', 'uses'=> 'Admin\MessageController@edit'));	
	Route::get('admin/test_view', array('as'=>'admin.test_view', 'uses'=> 'AdminController@test_view'));

	// Menu User / Pengguna
	Route::get('admin/user',array('as'=>'admin.user', 'uses'=> 'AdminController@index_user'));
	Route::get('admin/tambahuser',array('as'=>'admin.user.tambah_user', 'uses'=> 'AdminController@showTambahUser'));	
	Route::post('admin/user/tambah',array('as'=>'admin.user.tambah', 'uses'=> 'AdminController@createAkunNew'));
	Route::get('admin/user/{id}/hapus', array('as'=>'admin.hapususer', 'uses'=> 'AdminController@hapus'));
	Route::get('admin/user/{id}/edit', array('as'=>'admin.edituser', 'uses'=> 'AdminController@edituser'));	
	Route::put('admin/user/{id}/simpanedit', array('as'=>'admin.user.simpanedit', 'uses'=> 'AdminController@simpanedit'));	
	Route::get('admin/user/{id_user}/ubahpassword',array('as'=>'admin.user.ubah_password', 'uses'=> 'AdminController@showUbahPasswordUserAdmin'));
	Route::post('admin/user/simpanubahpassworduser', array('as'=>'admin.user.simpanedit', 'uses'=> 'AdminController@simpanubahpassworduser'));	

});

//Route as guru
Route::group(['middleware' => ['web','auth','level:12']], function()    
{	
	// Kelas
	Route::get('guru/kelas',array('as'=>'guru.kelas', 'uses'=> 'Admin\KelasController@index_guru'));
	// Materi Ajar 
	Route::get('guru/materi_ajar',array('as'=>'guru.materi_ajar', 'uses'=> 'Admin\MateriAjarController@index_guru'));
	Route::get('guru/tambahmateri_ajar', array('as'=>'guru.tambahmateri_ajar.show', 'uses'=> 'Admin\MateriAjarController@showTambahMateriAjar_guru'));
	Route::post('guru/materi_ajar/tambah', array('as'=>'guru.tambahmateri_ajar', 'uses'=> 'Admin\MateriAjarController@tambah_guru'));
	Route::get('guru/materi_ajar/{id}/hapus', array('as'=>'guru.hapusmateri_ajar', 'uses'=> 'Admin\MateriAjarController@hapus_guru'));
	Route::get('guru/materi_ajar/{id}/edit', array('as'=>'guru.editmateri_ajar', 'uses'=> 'Admin\MateriAjarController@editmateri_ajar_guru'));
	Route::put('guru/materi_ajar/{id}/simpanedit', array('as'=>'guru.materi_ajar.simpanedit', 'uses'=> 'Admin\MateriAjarController@simpanedit_guru'));
	Route::get('guru/materi_ajar/{id}/download', array('as'=>'guru.download_materi_ajar', 'uses'=> 'Admin\MateriAjarController@download_guru'));	
	// Tugas 	
	Route::get('guru/tugas',array('as'=>'guru.tugas', 'uses'=> 'Admin\TugasController@index'));
	Route::get('guru/tambahtugas', array('as'=>'guru.tambahtugas.show', 'uses'=> 'Admin\TugasController@showTambahTugas'));
	Route::post('guru/tugas/tambah', array('as'=>'guru.tambahtugas', 'uses'=> 'Admin\TugasController@tambah'));
	Route::get('guru/tugas/{id}/hapus', array('as'=>'guru.hapustugas', 'uses'=> 'Admin\TugasController@hapus'));
	Route::get('guru/tugas/{id}/edit', array('as'=>'guru.edittugas', 'uses'=> 'Admin\TugasController@edittugas'));
	Route::put('guru/tugas/{id}/simpanedit', array('as'=>'guru.tugas.simpanedit', 'uses'=> 'Admin\TugasController@simpanedit'));		
	Route::get('guru/tugas/{id}/peserta_koreksi', array('as'=>'guru.peserta_koreksi', 'uses'=> 'Admin\TugasController@ShowPesertaKoreksiTugas'));
	Route::put('guru/tugas/siswa/{id}/update_nilai_tugas', array('as'=>'guru.peserta_koreksi', 'uses'=> 'Admin\TugasController@updateNilaiTugasSiswa'));
	Route::get('guru/message/send/{id}/edit', array('as'=>'guru.message_edit.send', 'uses'=> 'Admin\MessageController@edit'));
	Route::post('guru/message/sending', array('as'=>'guru.message.sendEditedMessage', 'uses'=> 'Admin\MessageController@sendEditedMessage'));
	// Download Tugas Siswa
	Route::get('guru/tugas/{id}/download_tugas_siswa', array('as'=>'guru.download_tugas', 'uses'=> 'Admin\TugasController@download_tugas_siswa'));
	// Ujian 
	Route::get('guru/ujian',array('as'=>'guru.ujian', 'uses'=> 'Admin\UjianController@index'));
	Route::get('guru/tambahujian', array('as'=>'guru.tambahujian.show', 'uses'=> 'Admin\UjianController@showTambahUjian'));
	Route::post('guru/ujian/tambah', array('as'=>'guru.tambahujian', 'uses'=> 'Admin\UjianController@tambah'));
	Route::get('guru/ujian/{id}/hapus', array('as'=>'guru.hapusujian', 'uses'=> 'Admin\UjianController@hapus'));
	Route::get('guru/ujian/{id}/edit', array('as'=>'guru.editujian', 'uses'=> 'Admin\UjianController@editujian'));
	Route::put('guru/ujian/{id}/simpanedit', array('as'=>'guru.ujian.simpanedit', 'uses'=> 'Admin\UjianController@simpanedit'));
	Route::get('guru/ujian/{id}/detail', array('as'=>'guru.detail_ujian', 'uses'=> 'Admin\UjianController@detail'));
	Route::get('guru/ujian_siswa/{id}/hapus', array('as'=>'guru.hapus_ujian_siswa', 'uses'=> 'Admin\UjianController@destroy'));
	Route::get('guru/siswa_ujian/{id}', array('as'=>'guru.siswa_ujian.show', 'uses'=> 'Admin\SiswaJawabUjianController@show'));
	Route::get('guru/ujian/{id}', array('as'=>'.ujian.show', 'uses'=> 'Admin\UjianController@show'));
	// Soal Ujian 
	Route::get('guru/soal_ujian',array('as'=>'guru.soal_ujian', 'uses'=> 'Admin\SoalUjianController@index'));
	Route::get('guru/tambah_soal_ujian', array('as'=>'guru.tambah_soal_ujian.show', 'uses'=> 'Admin\SoalUjianController@showTambahSoalUjian'));
	Route::post('guru/soal_ujian/tambah', array('as'=>'guru.tambah_soal_ujian', 'uses'=> 'Admin\SoalUjianController@tambah'));
	Route::get('guru/soal_ujian/{id}/hapus', array('as'=>'guru.hapusujian', 'uses'=> 'Admin\SoalUjianController@hapus'));
	Route::get('guru/soal_ujian/{id}/edit', array('as'=>'guru.editujian', 'uses'=> 'Admin\SoalUjianController@edit'));
	Route::put('guru/soal_ujian/{id}/simpanedit', array('as'=>'guru.soal_ujian.simpanedit', 'uses'=> 'Admin\SoalUjianController@simpanedit'));
	Route::get('guru/soal_ujian/{id}/detail', array('as'=>'guru.detail_soal_ujian', 'uses'=> 'Admin\SoalUjianController@detail'));
	// Show Nilai by Kelas
	Route::get('guru/nilai_siswa', array('as'=>'guru.nilai_siswa.kelas.mapel', 'uses'=>'Admin\NilaiController@showKelasNilai'));
	Route::post('guru/nilai_siswa', array('as'=>'guru.nilai_siswa.kelas.mapel', 'uses'=>'Admin\NilaiController@showKelasNilai'));


	//guru/guru
	Route::get('guru/guru/{id}/detail', array('as'=>'guru.detail_guru', 'uses'=> 'Admin\GuruController@detail_guru'));
	Route::get('guru/guru/ubahpassword',array('as'=>'guru.user.ubah_password', 'uses'=> 'AdminController@showUbahPasswordUser'));
	Route::post('guru/guru/simpanubahpassworduser', array('as'=>'guru.user.simpanedit', 'uses'=> 'AdminController@simpanubahpassworduser'));
	Route::get('guru/siswa_ujian/{id}', array('as'=>'guru.siswa_ujian.show', 'uses'=> 'Admin\SiswaJawabUjianController@show'));
	Route::get('guru/ujian/{id}', array('as'=>'siswa.ujian.show', 'uses'=> 'Admin\UjianController@show'));	
	Route::get('guru/ujian_siswa/{id}/hapus', array('as'=>'guru.hapus_ujian_siswa', 'uses'=> 'Admin\UjianController@destroy'));
	// profile
	Route::get('guru/guru/edit', array('as'=>'guru.editguru', 'uses'=> 'Admin\GuruController@edit_asGuru'));
	Route::put('guru/guru/simpanedit', array('as'=>'guru.guru.simpanedit', 'uses'=> 'Admin\GuruController@simpanedit_asGuru'));

	// Form
	Route::get('guru/forum/{id_tugas}',array('as'=>'guru.forum', 'uses'=> 'Admin\ForumController@index_siswa'));	
	Route::post('guru/forum',array('as'=>'guru.forum', 'uses'=> 'Admin\ForumController@tambah'));
});

//Route as siswa
Route::group(['middleware' => ['web','auth','level:13']], function()    
{	
	// siswa/kelas_siswa
	Route::get('siswa/kelas_siswa',array('as'=>'siswa.kelas_siswa', 'uses'=> 'Admin\SiswaController@kelas_siswa'));
	// Materi Ajar 
	Route::get('siswa/materi_ajar',array('as'=>'siswa.materi_ajar', 'uses'=> 'Admin\MateriAjarController@index_siswa'));
	Route::get('siswa/materi_ajar/{id}/download', array('as'=>'siswa.download_materi_ajar', 'uses'=> 'Admin\MateriAjarController@download_siswa'));

	// siswa/pengumuman
	Route::get('siswa/pengumuman',array('as'=>'siswa.pengumuman', 'uses'=> 'Admin\PengumumanController@index_siswa'));
	Route::get('siswa/pengumuman/{id}/edit', array('as'=>'siswa.editpengumuman', 'uses'=> 'Admin\PengumumanController@detailpengumuman'));

	// siswa/nilai
	Route::get('siswa/nilai',array('as'=>'siswa.nilai', 'uses'=> 'Admin\NilaiController@showSiswaKelasNilai'));
	Route::post('siswa/nilai',array('as'=>'siswa.nilai', 'uses'=> 'Admin\NilaiController@showSiswaKelasNilai'));

	// siswa/tugas	
	Route::get('siswa/tugas/{id}/detail_tugas_siswa', array('as'=>'siswa.detail_tugas', 'uses'=> 'Admin\TugasController@show_detail_tugas_siswa'));
	Route::get('siswa/tugas/{id}/download_tugas_siswa', array('as'=>'siswa.download_tugas', 'uses'=> 'Admin\TugasController@download_tugas_siswa'));
	Route::post('siswa/tugas/tambah', array('as'=>'siswa.tambah.tugas', 'uses'=> 'Admin\TugasController@tambah_tugas_siswa'));
	Route::get('siswa/tugas/{id}/hapus', array('as'=>'siswa.hapusmateri_ajar', 'uses'=> 'Admin\TugasController@hapus_tugas_siswa'));
	Route::get('siswa/tugas/{id}/download', array('as'=>'siswa.download_materi_ajar', 'uses'=> 'Admin\MateriAjarController@download_tugas_siswa'));
	Route::get('siswa/tugas',array('as'=>'siswa.tugas', 'uses'=> 'Admin\TugasController@index_siswa'));


	// siswa/ujian
	Route::get('siswa/ujian',array('as'=>'siswa.ujian', 'uses'=> 'Admin\UjianController@index_siswa'));	
	Route::get('siswa/ujian/{id}/detail', array('as'=>'siswa.detail_ujian', 'uses'=> 'Admin\UjianController@detail'));
	Route::post('siswa/ujian',array('as'=>'siswa.ujian', 'uses'=> 'Admin\UjianController@store_siswa'));
	Route::get('siswa/ujian/{id}', array('as'=>'siswa.ujian.show', 'uses'=> 'Admin\UjianController@show'));	
	Route::get('siswa/siswa_ujian/{id}', array('as'=>'siswa.siswa_ujian.show', 'uses'=> 'Admin\SiswaJawabUjianController@show'));	
	Route::get('siswa/ujians/{ujians}/soals/{soals}', array('as'=>'siswa.soal_ujian.show', 'uses'=> 'Admin\SoalUjianController@show'));	
	Route::put('siswa/ujians/{ujians}/soals/{soals} ', array('as'=>'siswa.soal_ujian.show', 'uses'=> 'Admin\SoalUjianController@update'));	

	//siswa/siswa
	Route::get('siswa/siswa/{id}/detail', array('as'=>'siswa.detailsiswa', 'uses'=> 'Admin\SiswaController@detail_siswa'));
	Route::get('siswa/siswa/ubahpassword',array('as'=>'siswa.user.ubah_password', 'uses'=> 'AdminController@showUbahPasswordUser'));
	Route::post('siswa/siswa/simpanubahpassworduser', array('as'=>'siswa.user.simpanedit', 'uses'=> 'AdminController@simpanubahpassworduser'));
	// profile
	Route::get('siswa/siswa/edit', array('as'=>'siswa.editsiswa', 'uses'=> 'Admin\SiswaController@edit_asSiswa'));
	Route::put('siswa/siswa/simpanedit', array('as'=>'siswa.siswa.simpanedit', 'uses'=> 'Admin\SiswaController@simpanedit_asSiswa'));

	// Form
	Route::get('siswa/forum/{id_tugas}',array('as'=>'siswa.forum', 'uses'=> 'Admin\ForumController@index_siswa'));	
	Route::post('siswa/forum',array('as'=>'siswa.forum', 'uses'=> 'Admin\ForumController@tambah'));

});

