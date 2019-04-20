<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;

use Validator;
use App\Http\Controllers\Controller;
use App\NilaiUjianSiswa as NilaiUjian;
use App\MataPelajaran as Mapel;
use App\Ujian as Ujian;
use App\Siswa as Siswa;
use Session;

class NilaiUjianController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showTambahNilaiUjian()
  {
  	$idSiswa= Siswa::select(DB::raw("nisn_siswa, nama_siswa"))
        ->orderBy(DB::raw("nisn_siswa"))        
        ->get();
    $idMapel= Mapel::select(DB::raw("id_mapel,nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get(); 
    $idUjian= Ujian::select(DB::raw("id_ujian,judul_ujian"))
        ->orderBy(DB::raw("id_ujian"))        
        ->get();

    return view('admin.dashboard.nilai_ujian.tambah_nilai_ujian')
		->with('Siswa', $idSiswa)
        ->with('Mapel', $idMapel)
        ->with('Ujian', $idUjian);
  }

  public function index()
  {               
    $dataNilaiUjian = DB::table('nilai_ujian_siswas')   
     ->join('ujians', 'nilai_ujian_siswas.id_ujian', '=', 'ujians.id_ujian')                                   			       
     ->join('mata_pelajarans', 'nilai_ujian_siswas.id_mapel', '=', 'mata_pelajarans.id_mapel')
     ->join('siswas', 'nilai_ujian_siswas.nisn_siswa', '=', 'siswas.nisn_siswa')
     ->select('nilai_ujian_siswas.*', 'siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'ujians.judul_ujian')
     ->get();
        
    $data = array('nilai_ujian' => $dataNilaiUjian);   
    return view('admin.dashboard.nilai_ujian.nilai_ujian',$data);
  }    

 public function hapus($id_nilai_ujian_siswa )
  { 
  
    $id_nilai_ujian_siswa  = NilaiTugas::where('id_nilai_ujian_siswa ', '=', $id_nilai_ujian_siswa )->first();

    if ($id_nilai_ujian_siswa  == null)
      app::abort(404);
    
    Session::flash('flash_message', 'Data Nilai Ujian  : "'.$id_nilai_ujian_siswa ->nisn_siswa.'" Berhasil dihapus.');

    $id_nilai_ujian_siswa ->delete();
    
    return Redirect::action('Admin\NilaiUjianController@index');

  }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data | Request $request | Opsional | dipakai keduanya bisa juga
     * @return User
     */
  protected function tambah(Request $request)
  {
        $input =$request->all();
        $pesan = array(
          	'nisn_siswa.required' 	=> 'NISN Siswa dibutuhkan.',          	           
            'id_mapel.required' 	=> 'ID Mata Pelajaran dibutuhkan.',            
            'id_ujian.required' 	=> 'ID Ujian dibutuhkan.',                              
            'nilai_ujian.required' 	=> 'Nilai Ujian dibutuhkan.', 
                     
        );

        $aturan = array(
            'nisn_siswa'  	=> 'required',          
            'id_mapel'  	=> 'required',
            'id_ujian'  	=> 'required',            
            'nilai_ujian'  	=> 'required',                      
        );        

        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses

        $nilai_ujian = new NilaiUjian;
        $nilai_ujian->nisn_siswa    = $request['nisn_siswa'];
        $nilai_ujian->id_mapel     	= $request['id_mapel'];
        $nilai_ujian->id_ujian     	= $request['id_ujian'];
        $nilai_ujian->nilai_ujian   = $request['nilai_ujian'];
                                                    
        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $nilai_ujian->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data Nilai Ujian "'.$request['nisn_siswa'].'" Berhasil disimpan.');

        return Redirect::action('Admin\NilaiUjianController@index');
  }  

 public function edit($id_nilai_ujian_siswa )
    {
        
        $data = NilaiTugas::find($id_nilai_ujian_siswa );
        $idSiswa= Siswa::select(DB::raw("nisn_siswa, nama_siswa"))
            ->orderBy(DB::raw("nisn_siswa"))        
            ->get();
        $idMapel= Mapel::select(DB::raw("id_mapel,nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get();
	    $idUjian= Ujian::select(DB::raw("id_ujian,judul_ujian"))
	        ->orderBy(DB::raw("id_ujian"))        
	        ->get();	    			
        
        return view('admin.dashboard.nilai_ujian.edit_nilai_ujian',$data)
                ->with('Siswa', $idSiswa)
		        ->with('Mapel', $idMapel)
		        ->with('Ujian', $idUjian);

    }

 public function simpanedit($id_nilai_ujian_siswa )
    {
        $input =Input::all();
        $messages = [
			'nisn_siswa.required' 	=> 'NISN Siswa dibutuhkan.',            
            'id_mapel.required' 	=> 'ID Mata Pelajaran dibutuhkan.',            
            'id_ujian.required' 	=> 'ID Ujian dibutuhkan.',                              
            'nilai_ujian.required' 	=> 'Nilai Ujian dibutuhkan.',			
        ];        

        $validator = Validator::make($input, [
        	'nisn_siswa'  	=> 'required',         
            'id_mapel'  	=> 'required',
            'id_ujian'  	=> 'required',            
            'nilai_ujian'  	=> 'required',                                                       
        ], $messages);
                     

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();          
        }
        # Bila validasi sukses
        $editNilai = NilaiTugas::find($id_nilai_ujian_siswa );
        $editNilai->nisn_siswa     	= $input['nisn_siswa'];
        $editNilai->id_mapel     	= $input['id_mapel'];
        $editNilai->id_ujian     	= $input['id_ujian'];                              
        $editNilai->nilai_ujian     = $input['nilai_ujian']; 

        if (! $editNilai->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Nilai : " '.$input['nisn_siswa'].'" Berhasil diubah.');

        return Redirect::action('Admin\NilaiUjianController@index'); 
    }
}

