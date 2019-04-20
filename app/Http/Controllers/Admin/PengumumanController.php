<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;

use Validator;
use App\Http\Controllers\Controller;
use App\Pengumuman as Pengumuman;
use Session;

class PengumumanController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showTambahPengumuman()
  {
    return view('admin.dashboard.pengumuman.tambah_pengumuman');
  }

  public function index()
  {
    $dataPengumuman = Pengumuman::select(DB::raw("id_pengumuman, judul, deskripsi, author,created_at, updated_at"))
        ->orderBy(DB::raw("id_pengumuman"))        
        ->get();
        
    $data = array('pengumuman' => $dataPengumuman);   
    return view('admin.dashboard.pengumuman.pengumuman',$data);
  }  

  public function index_siswa()
  {
    $dataPengumuman = Pengumuman::select(DB::raw("id_pengumuman, judul, deskripsi, author, created_at, updated_at"))
        ->orderBy(DB::raw("id_pengumuman"))        
        ->get();
        
    $data = array('pengumuman' => $dataPengumuman);   
    return view('admin.dashboard.pengumuman.pengumuman',$data);
  }   

  public function hapus($id_pengumuman)
  {
  
    $id_pengumuman = Pengumuman::where('id_pengumuman', '=', $id_pengumuman)->first();

    if ($id_pengumuman == null)
      app::abort(404);
    
    Session::flash('flash_message', 'Data Pengumuman "'.$id_pengumuman->id_pengumuman.'" - "'.$id_pengumuman->judul.'" Berhasil dihapus.');

    $id_pengumuman->delete();
    
    return Redirect::action('Admin\PengumumanController@index');

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
            'judul.required' => 'Judul dibutuhkan.',
            'deskripsi.required' => 'Deskripsi dibutuhkan.',
            'author.required' => 'Author dibutuhkan.',          
        );

        $aturan = array(
            'judul'      => 'required',
            'deskripsi'  => 'required',
            'author'     => 'required',            
        );
        

        $validator = Validator::make($input,$aturan, $pesan);
        // dd($validator);
        
        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses

        $pengumuman = new Pengumuman;
        $pengumuman->judul     = $request['judul'];
        $pengumuman->deskripsi = $request['deskripsi'];
        $pengumuman->author    = $request['author'];      

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $pengumuman->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data Pengumuman "'.$request['judul'].'" - " '.$request['author'].'" Berhasil disimpan.');

        return Redirect::action('Admin\PengumumanController@index');
  }  

 public function editpengumuman($id_pengumuman)
    {

        $data = Pengumuman::find($id_pengumuman);
        $pengumuman = Pengumuman::orderBy('id_pengumuman')->get();

        return view('admin.dashboard.pengumuman.edit_pengumuman',$data)
                ->with('list_pengumuman', $pengumuman);
    }

 public function simpanedit($id_pengumuman)
    {
        $input =Input::all();
        $messages = [
            'judul.required' => 'Judul dibutuhkan.',
            'deskripsi.required' => 'Deskripsi dibutuhkan.',
            'author.required' => 'Author dibutuhkan.',           
        ];
        

        $validator = Validator::make($input, [
 			      'judul'      => 'required',
            'deskripsi'  => 'required',
            'author'     => 'required', 
        ], $messages);
                     

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();          
        }
        # Bila validasi sukses
        $editPengumuman = Pengumuman::find($id_pengumuman);
        $editPengumuman->judul     = $input['judul'];
        $editPengumuman->deskripsi = $input['deskripsi'];
        $editPengumuman->author    = $input['author'];        

        if (! $editPengumuman->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Pengumuman No. "'.$input['id_pengumuman'].'" dengan judul " '.$input['judul'].'" Berhasil diubah.');

        return Redirect::action('Admin\PengumumanController@index'); 
    }
}
