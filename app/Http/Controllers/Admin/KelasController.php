<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Auth;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kelas as Kelas;
use App\Guru as Guru;
use App\MataPelajaran as MataPelajaran;

class KelasController extends Controller
{
 
  public function showTambahKelas()
  {
  	$idMapel= MataPelajaran::select(DB::raw("id_mapel, nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get();
    return view('admin.dashboard.kelas.tambah_kelas')
    		->with('Mapel', $idMapel);
  }

  public function index()
  {
    $dataKelas = DB::table('kelas_have_mata_pelajarans')                  
                 ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                 ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get();         
    $data = array('kelas' => $dataKelas);   
    return view('admin.dashboard.kelas.kelas',$data);
  }   

  public function index_guru()
  {
    $guru = Guru::where('id_user', Auth::user()->id_user)->first();
    $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();
    $dataKelas = DB::table('kelas_have_mata_pelajarans')                  
                 ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                 ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                 ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get();         
    $data = array('kelas' => $dataKelas);   
    return view('admin.dashboard.kelas.kelas',$data);
  }     

  public function hapus($id)
  {
  
    $kelas = Kelas::where('id', '=', $id)->first();

    if ($kelas == null)
      app::abort(404);
    
    Session::flash('flash_message', 'Data Kelas "'.$kelas->nama_kelas.'" - "'.$kelas->id_mapel.'" Berhasil dihapus.');

    $kelas->delete();
    
    return Redirect::action('Admin\KelasController@index');

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
            'nama_kelas.required' => 'Judul dibutuhkan.',
            'id_mapel.required' => 'Deskripsi dibutuhkan.',                    
        );

        $aturan = array(
            'nama_kelas'=> 'required',
            'id_mapel'  => 'required',           
        );        
        $validator = Validator::make($input,$aturan, $pesan);        
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // revisi
        $dataKelas = Kelas::all();
        foreach ($dataKelas as $data) {
          if ($data->nama_kelas == $request['nama_kelas'] && $data->id_mapel == $request['id_mapel']) {
            Session::flash('flash_message', 'Data Kelas dan mata pelajaran sudah ada. Periksa Kembali !!!');
            return Redirect::back()->withInput();
          }
        }

        $kelas = new Kelas;
        $kelas->nama_kelas     	= $request['nama_kelas'];
        $kelas->id_mapel 		= $request['id_mapel'];      

        if (! $kelas->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data Kelas "'.$request['nama_kelas'].'" - " '.$request['id_mapel'].'" Berhasil disimpan.');

        return Redirect::action('Admin\KelasController@index');
  }  

 public function editkelas($id)
    {
        $data = Kelas::find($id);        
        $idMapel= MataPelajaran::select(DB::raw("id_mapel, nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get();
        return view('admin.dashboard.kelas.edit_kelas',$data)
                ->with('Mapel', $idMapel);
    }

 public function simpanedit($id)
    {
        $input =Input::all();
        $messages = [
            'nama_kelas.required' => 'Judul dibutuhkan.',
            'id_mapel.required' => 'Deskripsi dibutuhkan.',           
        ];        

        $validator = Validator::make($input, [
            'nama_kelas'  => 'required',
            'id_mapel'  => 'required',
        ], $messages);
                     

        if($validator->fails()) {        
            return Redirect::back()->withErrors($validator)->withInput();          
        }
         
        $editKelas = Kelas::find($id);
        $editKelas->nama_kelas     = $input['nama_kelas'];
        $editKelas->id_mapel = $input['id_mapel'];     

        if (! $editKelas->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Kelas "'.$input['nama_kelas'].'" id mapel " '.$input['id_mapel'].'" Berhasil diubah.');

        return Redirect::action('Admin\KelasController@index'); 
    }
}
