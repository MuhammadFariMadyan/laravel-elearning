<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Auth;

use Validator;
use App\Http\Controllers\Controller;
use App\Siswa as Siswa;
use App\User as User;
use Session;

class SiswaController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showTambahSiswa()
  {
  	$idUser= User::select(DB::raw("id_user, username"))
        ->orderBy(DB::raw("id_user"))        
        ->get();
    return view('admin.dashboard.siswa.tambah_siswa')
    		->with('listIduser', $idUser);;
  }

  public function detail($nisn_siswa)
  {
    $data = Siswa::find($nisn_siswa);
    $user= User::select(DB::raw("id_user, username, password"))
    ->orderBy(DB::raw("id_user"))        
    ->get();        
    $siswa = Siswa::orderBy('nisn_siswa')->get();
    
    // $idUserSiswa = '3';
    // $siswa = \App\Siswa::where('id_user', '3')->first(); 
    // dd($siswa->foto_siswa);
    return view('admin.dashboard.siswa.detail_siswa',$data)
            ->with('siswa', $siswa)
            ->with('userData', $user);

    // $dataSiswa = Siswa::select(DB::raw("nisn_siswa,nama_siswa,email_siswa,no_hp_siswa,ttl_siswa,jns_kelamin_siswa,alamat_siswa,kelas_siswa,foto_siswa,status_siswa,id_user"))
    //     ->orderBy(DB::raw("nisn_siswa"))        
    //     ->get();
        
    // $data = array('siswa' => $dataSiswa);   
    // return view('admin.dashboard.siswa.detail_siswa',$data);
  }

  public function detail_siswa($nisn_siswa)
  {
    $data = Siswa::find($nisn_siswa); 
                
    return view('admin.dashboard.siswa.detail_siswa',$data);
            
  }

  public function siswa_detail($nisn_siswa)
  {
    $data = Siswa::find($nisn_siswa);    
    return view('admin.dashboard.siswa.detail_siswa',$data);          
  }

  public function kelas_siswa()
  {
    $siswa = Siswa::where('id_user', Auth::user()->id_user)->first();
    $data = Siswa::where('nisn_siswa',$siswa->nisn_siswa)->first();
    $listSiswaKelas = Siswa::where('kelas_siswa', $data->kelas_siswa)->get();
    // dd($listSiswaKelas);
    $dataKelas = DB::table('kelas_have_mata_pelajarans')                  
                 ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                 ->where('kelas_have_mata_pelajarans.nama_kelas', $siswa->kelas_siswa)
                 ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get(); 

    return view('admin.dashboard.siswa.kelas_siswa',$data)
            ->with('siswa', $listSiswaKelas)
            ->with('kelas', $dataKelas);
  }

  public function index()
  {
    $dataSiswa = Siswa::select(DB::raw("nisn_siswa,nama_siswa,email_siswa,no_hp_siswa,ttl_siswa,jns_kelamin_siswa,alamat_siswa,kelas_siswa,foto_siswa,status_siswa,id_user"))
        ->orderBy(DB::raw("nisn_siswa"))        
        ->get();
        
    $data = array('siswa' => $dataSiswa);   
    return view('admin.dashboard.siswa.siswa',$data);
  }    

  public function hapus($nisn_siswa)
  { 
  
    $nisn_siswa = Siswa::where('nisn_siswa', '=', $nisn_siswa)->first();

    if ($nisn_siswa == null)
      app::abort(404);
    
    Session::flash('flash_message', 'Data Siswa "'.$nisn_siswa->nisn_siswa.'" - "'.$nisn_siswa->nama_siswa.'" Berhasil dihapus.');
    $image_path = public_path().'/upload_gambar/'.$nisn_siswa->foto_siswa;
    $nisn_siswa->delete();
    unlink($image_path);
    return Redirect::action('Admin\SiswaController@index');

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
            'nisn_siswa.required' 		 	=> 'nisn siswa dibutuhkan.',
            'nama_siswa.required' 			=> 'nama siswa dibutuhkan.',
            'email_siswa.required' 			=> 'email siswa dibutuhkan.', 
            'no_hp_siswa.required' 			=> 'no hp siswa dibutuhkan.',
            'ttl_siswa.required' 			=> 'ttl siswa dibutuhkan.',
            'jns_kelamin_siswa.required' 	=> 'jenis kelamin siswa dibutuhkan.', 
            'alamat_siswa.required' 		=> 'alamat siswa dibutuhkan.',
            'kelas_siswa.required' 			=> 'kelas siswa dibutuhkan.',
            'foto_siswa.required' 			=> 'foto siswa dibutuhkan.', 
            'status_siswa.required' 		=> 'status siswa dibutuhkan.',
            'id_user.required' 				=> 'id user dibutuhkan.',       
                     
        );

        $aturan = array(
            'nisn_siswa'      	=> 'required|numeric',
            'nama_siswa'  		=> 'required',
            'email_siswa'     	=> 'required',
            'no_hp_siswa'       => 'required',
            'ttl_siswa'         => 'required',
            'jns_kelamin_siswa' => 'required',
            'alamat_siswa'      => 'required',
            'kelas_siswa'  		=> 'required',
            'foto_siswa'     	=> 'required|image:png,gif,jpeg,jpg',
            'status_siswa'      => 'required',
            // 'id_user'  			=> 'required',                      
        );
        

        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses                        

        $foto_siswa = $request->file('foto_siswa');         
        $namaFotoSiswa = $foto_siswa->getClientOriginalName();
        $request->file('foto_siswa')->move('upload_gambar', $namaFotoSiswa);

        $siswa = new Siswa;
        $siswa->nisn_siswa     		= $request['nisn_siswa'];
        $siswa->nama_siswa     		= $request['nama_siswa'];
        $siswa->email_siswa     	= $request['email_siswa'];
        $siswa->no_hp_siswa     	= $request['no_hp_siswa'];
        $siswa->ttl_siswa     		= $request['ttl_siswa'];
        $siswa->jns_kelamin_siswa   = $request['jns_kelamin_siswa'];
        $siswa->alamat_siswa     	= $request['alamat_siswa'];
        $siswa->kelas_siswa     	= $request['kelas_siswa'];
        $siswa->foto_siswa     		= $namaFotoSiswa;
        $siswa->status_siswa     	= $request['status_siswa'];
        $siswa->id_user     		= $request['id_user'];   
                    
        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $siswa->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data Siswa "'.$request['nisn_siswa'].'" - " '.$request['nama_siswa'].'" Berhasil disimpan.');

        return Redirect::action('Admin\SiswaController@index');
  }  

 public function editsiswa($nisn_siswa)
    {
        $data = Siswa::find($nisn_siswa);
        $user= User::select(DB::raw("id_user, username"))
        ->orderBy(DB::raw("id_user"))        
        ->get();        
        $siswa = Siswa::orderBy('nisn_siswa')->get();

        return view('admin.dashboard.siswa.edit_siswa',$data)
                ->with('list_siswa', $siswa)
                ->with('userData', $user);
    }

 public function simpanedit($nisn_siswa)
    {
        $input =Input::all();
        // dd($input);
        $messages = [
            'nisn_siswa.required' 		 	=> 'nisn siswa dibutuhkan.',
            'nama_siswa.required' 			=> 'nama siswa dibutuhkan.',
            'email_siswa.required' 			=> 'email siswa dibutuhkan.', 
            'no_hp_siswa.required' 			=> 'no hp siswa dibutuhkan.',
            'ttl_siswa.required' 			=> 'ttl siswa dibutuhkan.',
            'jns_kelamin_siswa.required' 	=> 'jenis kelamin siswa dibutuhkan.', 
            'alamat_siswa.required' 		=> 'alamat siswa dibutuhkan.',
            'kelas_siswa.required' 			=> 'kelas siswa dibutuhkan.',
            'foto_siswa.required' 			=> 'foto siswa dibutuhkan.', 
            'status_siswa.required' 		=> 'status siswa dibutuhkan.',
            // 'id_user.required' 				=> 'id user dibutuhkan.',                                          
        ];
        
        $validator = Validator::make($input, [
 			'nisn_siswa'      	=> 'required|numeric',
            'nama_siswa'  		=> 'required',
            'email_siswa'     	=> 'required',
            'no_hp_siswa'       => 'required',
            'ttl_siswa'         => 'required',
            'jns_kelamin_siswa' => 'required',
            'alamat_siswa'      => 'required',
            'kelas_siswa'  		=> 'required',
            'foto_siswa'     	=> 'sometimes|image:png,gif,jpeg,jpg',
            'status_siswa'      => 'required',
            // 'id_user'  			=> 'required',                        
        ], $messages);                             

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses

        $siswa = Siswa::findOrFail($nisn_siswa);
        // cek apakah ada file baru di form ?
        if (Input::hasFile('foto_siswa')) {
          $foto_siswa = $input['foto_siswa'];        
          $namaFotoSiswa = $foto_siswa->getClientOriginalName();
                  
          // hapus file lama
          // $image_path = public_path().'/upload_gambar/'.$siswa->foto_siswa;
          // unlink($image_path);        

          // upload file baru
          $input['foto_siswa']->move('upload_gambar', $namaFotoSiswa);
          // save data ke tabel dengan file baru
          $editSiswa = Siswa::find($nisn_siswa);
          $editSiswa->nisn_siswa          = $input['nisn_siswa'];
          $editSiswa->nama_siswa          = $input['nama_siswa'];
          $editSiswa->email_siswa         = $input['email_siswa'];
          $editSiswa->no_hp_siswa         = $input['no_hp_siswa'];
          $editSiswa->ttl_siswa           = $input['ttl_siswa'];
          $editSiswa->jns_kelamin_siswa   = $input['jns_kelamin_siswa'];
          $editSiswa->alamat_siswa        = $input['alamat_siswa'];
          $editSiswa->kelas_siswa         = $input['kelas_siswa'];
          $editSiswa->foto_siswa          = $namaFotoSiswa;
          $editSiswa->status_siswa        = $input['status_siswa'];
          $editSiswa->id_user             = $input['id_user'];
        } else {
          // save data ke tabel tanpa merubah dan menghapus file lama
          $foto_siswa = $siswa->foto_siswa;
          
          $editSiswa = Siswa::find($nisn_siswa);
          $editSiswa->nisn_siswa          = $input['nisn_siswa'];
          $editSiswa->nama_siswa          = $input['nama_siswa'];
          $editSiswa->email_siswa         = $input['email_siswa'];
          $editSiswa->no_hp_siswa         = $input['no_hp_siswa'];
          $editSiswa->ttl_siswa           = $input['ttl_siswa'];
          $editSiswa->jns_kelamin_siswa   = $input['jns_kelamin_siswa'];
          $editSiswa->alamat_siswa        = $input['alamat_siswa'];
          $editSiswa->kelas_siswa         = $input['kelas_siswa'];          
          $editSiswa->status_siswa        = $input['status_siswa'];
          $editSiswa->id_user             = $input['id_user']; 
        }        
        
        if (! $editSiswa->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Siswa "'.$input['nisn_siswa'].'" dengan nama" '.$input['nama_siswa'].'" Berhasil diubah.');

        return Redirect::action('Admin\SiswaController@index'); 
    }

// siswa
public function edit_asSiswa()
    {   
        $siswa = Siswa::where('id_user', Auth::user()->id_user)->first();        
        $data = Siswa::find($siswa->nisn_siswa);   

        $user= User::select(DB::raw("id_user, username"))
        ->orderBy(DB::raw("id_user"))        
        ->get();        

        return view('admin.dashboard.siswa.edit_siswa',$data)
                ->with('userData', $user);
    }

 public function simpanedit_asSiswa()
    {

        $input =Input::all();
        // dd($input);
        $messages = [
            'nisn_siswa.required'       => 'nisn siswa dibutuhkan.',
            'nama_siswa.required'       => 'nama siswa dibutuhkan.',
            'email_siswa.required'      => 'email siswa dibutuhkan.', 
            'no_hp_siswa.required'      => 'no hp siswa dibutuhkan.',
            'ttl_siswa.required'      => 'ttl siswa dibutuhkan.',
            'jns_kelamin_siswa.required'  => 'jenis kelamin siswa dibutuhkan.', 
            'alamat_siswa.required'     => 'alamat siswa dibutuhkan.',
            'kelas_siswa.required'      => 'kelas siswa dibutuhkan.',
            'foto_siswa.required'       => 'foto siswa dibutuhkan.', 
            'status_siswa.required'     => 'status siswa dibutuhkan.',
            // 'id_user.required'         => 'id user dibutuhkan.',                                          
        ];
        
        $validator = Validator::make($input, [
      'nisn_siswa'        => 'required|numeric',
            'nama_siswa'      => 'required',
            'email_siswa'       => 'required',
            'no_hp_siswa'       => 'required',
            'ttl_siswa'         => 'required',
            'jns_kelamin_siswa' => 'required',
            'alamat_siswa'      => 'required',
            'kelas_siswa'     => 'required',
            'foto_siswa'      => 'sometimes|image:png,gif,jpeg,jpg',
            'status_siswa'      => 'required',
            // 'id_user'        => 'required',                        
        ], $messages);                             

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses

        $siswa = Siswa::findOrFail($input['nisn_siswa']);
        // cek apakah ada file baru di form ?
        if (Input::hasFile('foto_siswa')) {
          $foto_siswa = $input['foto_siswa'];        
          $namaFotoSiswa = $foto_siswa->getClientOriginalName();
          
          // cek pada atribut siswa, jika ada maka hapus file lama
        if (!$siswa->foto_siswa == "") {
          // hapus file lama
          // $image_path = public_path().'/upload_gambar/'.$siswa->foto_siswa;
          // unlink($image_path);        
        }                   

          // upload file baru
          $input['foto_siswa']->move('upload_gambar', $namaFotoSiswa);
          // save data ke tabel dengan file baru
          $editSiswa = Siswa::find($input['nisn_siswa']);
          $editSiswa->nama_siswa          = $input['nama_siswa'];
          $editSiswa->email_siswa         = $input['email_siswa'];
          $editSiswa->no_hp_siswa         = $input['no_hp_siswa'];
          $editSiswa->ttl_siswa           = $input['ttl_siswa'];
          $editSiswa->jns_kelamin_siswa   = $input['jns_kelamin_siswa'];
          $editSiswa->alamat_siswa        = $input['alamat_siswa'];
          $editSiswa->kelas_siswa         = $input['kelas_siswa'];
          $editSiswa->foto_siswa          = $namaFotoSiswa;
        } else {
          // save data ke tabel tanpa merubah dan menghapus file lama
          // $foto_siswa = $siswa->foto_siswa;
          
          $editSiswa = Siswa::find($input['nisn_siswa']);
          $editSiswa->nama_siswa          = $input['nama_siswa'];
          $editSiswa->email_siswa         = $input['email_siswa'];
          $editSiswa->no_hp_siswa         = $input['no_hp_siswa'];
          $editSiswa->ttl_siswa           = $input['ttl_siswa'];
          $editSiswa->jns_kelamin_siswa   = $input['jns_kelamin_siswa'];
          $editSiswa->alamat_siswa        = $input['alamat_siswa'];
          $editSiswa->kelas_siswa         = $input['kelas_siswa'];                   
        }        
        
        if (! $editSiswa->save())
          App::abort(500);

        Session::flash('flash_message', 'Data kamu " '.$input['nama_siswa'].' " Berhasil diubah.');

        return redirect('siswa/siswa/'.$input['nisn_siswa'].'/detail'); 
    }

    // Forum
    
}

