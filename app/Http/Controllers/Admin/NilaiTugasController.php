<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;

use Validator;
use App\Http\Controllers\Controller;
use App\NilaiTugasSiswa as NilaiTugas;
use App\MataPelajaran as Mapel;
use App\Tugas as Tugas;
use App\Siswa as Siswa;
use Session;

class NilaiTugasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showTambahNilaiTugas()
  {
  	$idSiswa= Siswa::select(DB::raw("nisn_siswa, nama_siswa"))
        ->orderBy(DB::raw("nisn_siswa"))        
        ->get();
    $idMapel= Mapel::select(DB::raw("id_mapel,nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get();
    $idTugas= Tugas::select(DB::raw("id_tugas,judul_tugas"))
        ->orderBy(DB::raw("id_tugas"))        
        ->get();

    return view('admin.dashboard.nilai_tugas.tambah_nilai_tugas')
		->with('Siswa', $idSiswa)
        ->with('Mapel', $idMapel)
        ->with('Tugas', $idTugas);
  }

  public function index()
  {               
    $dataNilaiTugas = DB::table('nilai_tugas_siswas')   
     ->join('tugass', 'nilai_tugas_siswas.id_tugas', '=', 'tugass.id_tugas')                                   			       
     ->join('mata_pelajarans', 'nilai_tugas_siswas.id_mapel', '=', 'mata_pelajarans.id_mapel')
     ->join('siswas', 'nilai_tugas_siswas.nisn_siswa', '=', 'siswas.nisn_siswa')
     ->select('nilai_tugas_siswas.*', 'siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'tugass.judul_tugas')
     ->get();
        
    $data = array('nilai_tugas' => $dataNilaiTugas);   
     // dd($data);
    return view('admin.dashboard.nilai_tugas.nilai_tugas',$data);
  }    

 public function hapus($id_nilai_tugas_siswa )
  { 
  
    $id_nilai_tugas_siswa  = NilaiTugas::where('id_nilai_tugas_siswa ', '=', $id_nilai_tugas_siswa )->first();

    if ($id_nilai_tugas_siswa  == null)
      app::abort(404);
    
    Session::flash('flash_message', 'Data Nilai Tugas : "'.$id_nilai_tugas_siswa ->nisn_siswa.'" Berhasil dihapus.');

    $id_nilai_tugas_siswa ->delete();
    
    return Redirect::action('Admin\NilaiTugasController@index');

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
            'id_tugas.required' 	=> 'ID Tugas dibutuhkan.',                              
            'nilai_tugas.required' 	=> 'Nilai Tugas dibutuhkan.', 
                     
        );

        $aturan = array(
            'nisn_siswa'  	=> 'required',
            'id_mapel'  	=> 'required',            
            'id_tugas'  	=> 'required',            
            'nilai_tugas'  	=> 'required',                      
        );        

        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses

        $nilai_tugas = new NilaiTugas;
        $nilai_tugas->nisn_siswa    = $request['nisn_siswa'];
        $nilai_tugas->id_mapel     	= $request['id_mapel'];
        $nilai_tugas->id_tugas     	= $request['id_tugas'];
        $nilai_tugas->nilai_tugas   = $request['nilai_tugas'];
                                                    
        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $nilai_tugas->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data Nilai Tugas "'.$request['nisn_siswa'].'" Berhasil disimpan.');

        return Redirect::action('Admin\NilaiTugasController@index');
  }  

 public function edit($id_nilai_tugas_siswa )
    {
        
        $data = NilaiTugas::find($id_nilai_tugas_siswa );
        $idSiswa= Siswa::select(DB::raw("nisn_siswa, nama_siswa"))
            ->orderBy(DB::raw("nisn_siswa"))        
            ->get();
        $idMapel= Mapel::select(DB::raw("id_mapel,nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get();
	    $idTugas= Tugas::select(DB::raw("id_tugas,judul_tugas"))
	        ->orderBy(DB::raw("id_tugas"))        
	        ->get();	    			
        
        return view('admin.dashboard.nilai_tugas.edit_nilai_tugas',$data)
                ->with('Siswa', $idSiswa)
		        ->with('Mapel', $idMapel)
		        ->with('Tugas', $idTugas);

    }

 public function simpanedit($id_nilai_tugas_siswa )
    {
        $input =Input::all();
        $messages = [
			'nisn_siswa.required' 	=> 'NISN Siswa dibutuhkan.',
            'id_mapel.required' 	=> 'ID Mata Pelajaran dibutuhkan.',            
            'id_tugas.required' 	=> 'ID Tugas dibutuhkan.',                              
            'nilai_tugas.required' 	=> 'Nilai Tugas dibutuhkan.',                                            
        ];        

        $validator = Validator::make($input, [
        	'nisn_siswa'  	=> 'required',
            'id_mapel'  	=> 'required',            
            'id_tugas'  	=> 'required',            
            'nilai_tugas'  	=> 'required',          
            
        ], $messages);
                     

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();          
        }
        # Bila validasi sukses
        $editNilai = NilaiTugas::find($id_nilai_tugas_siswa );
        $editNilai->nisn_siswa     	= $input['nisn_siswa'];
        $editNilai->id_mapel     	= $input['id_mapel'];
        $editNilai->id_tugas     	= $input['id_tugas'];                              
        $editNilai->nilai_tugas     = $input['nilai_tugas']; 

        if (! $editNilai->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Nilai : " '.$input['nisn_siswa'].'" Berhasil diubah.');

        return Redirect::action('Admin\NilaiTugasController@index'); 
    }
}

