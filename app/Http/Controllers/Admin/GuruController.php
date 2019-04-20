<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use Auth;
use DB;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use App\Guru as Guru;
use App\User as User;

class GuruController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showTambahGuru()
  {
  	$idUser= User::select(DB::raw("id_user, username"))
        ->orderBy(DB::raw("id_user"))        
        ->get();
    return view('admin.dashboard.guru.tambah_guru')
    		->with('listIduser', $idUser);
  }

  public function detail($nip_guru)
  {
    $data = Guru::find($nip_guru);
    $guru = Guru::orderBy('nip_guru')->get();
    $user= User::select(DB::raw("id_user, username, password"))
            ->orderBy(DB::raw("id_user"))        
            ->get();    

    return view('admin.dashboard.guru.detail_guru',$data)
            ->with('guru', $guru)
            ->with('userData', $user);
  }

  public function detail_guru($nip_guru)
  {
    $data = Guru::find($nip_guru);
    $guru = Guru::orderBy('nip_guru')->get();
    $user= User::select(DB::raw("id_user, username, password"))
            ->orderBy(DB::raw("id_user"))        
            ->get();    

    return view('admin.dashboard.guru.detail_guru',$data)
            ->with('guru', $guru)
            ->with('userData', $user);
  }

  public function index()
  {
    $dataGuru = Guru::select(DB::raw("nip_guru,nama_guru,ttl_guru,jns_kelamin_guru,agama_guru,no_telp_guru,email_guru,alamat_guru,jabatan_guru,foto_guru,status_guru, id_user"))
        ->orderBy(DB::raw("nip_guru"))        
        ->get();
        
    $data = array('guru' => $dataGuru);   
    return view('admin.dashboard.guru.guru',$data);
  }    

  public function hapus($nip_guru)
  {
  
    $nip_guru = Guru::where('nip_guru', '=', $nip_guru)->first();

    if ($nip_guru == null)
      app::abort(404);
    
    Session::flash('flash_message', 'Data Guru "'.$nip_guru->nip_guru.'" - "'.$nip_guru->nama_guru.'" Berhasil dihapus.');
    $image_path = public_path().'/upload_gambar/'.$nip_guru->foto_guru;
    $nip_guru->delete();
    unlink($image_path);
    return Redirect::action('Admin\GuruController@index');

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
            'nip_guru.required' 		=> 'nip guru dibutuhkan.',
            'nama_guru.required' 		=> 'nama guru dibutuhkan.',
            'ttl_guru.required' 		=> 'ttl guru dibutuhkan.', 
            'jns_kelamin_guru.required' => 'jenis kelamin guru dibutuhkan.',
            'agama_guru.required' 		=> 'agama guru dibutuhkan.',
            'no_telp_guru.required' 	=> 'no telp guru dibutuhkan.', 
            'email_guru.required' 		=> 'email guru dibutuhkan.',
            'alamat_guru.required' 		=> 'alamat guru dibutuhkan.',
            'jabatan_guru.required' 	=> 'jabatan guru dibutuhkan.', 
            'foto_guru.required' 		=> 'foto guru dibutuhkan.',
            'status_guru.required' 		=> 'status guru dibutuhkan.',   
            'id_user.required' 				=> 'id user dibutuhkan.',       
        );

        $aturan = array(
            'nip_guru'      	=> 'required|numeric',
            'nama_guru'  		=> 'required',
            'ttl_guru'     		=> 'required',
            'jns_kelamin_guru' 	=> 'required',
            'agama_guru'        => 'required',
            'no_telp_guru' 		=> 'required',
            'email_guru'      	=> 'required',
            'alamat_guru'  		=> 'required',
            'jabatan_guru'     	=> 'required',
            'foto_guru'      	=> 'required|image:png,gif,jpeg,jpg',
            'status_guru'  		=> 'required', 
            'id_user'			=> 'required',         
        );
        

        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses
        $foto_guru = $request->file('foto_guru');
        $namaFotoGuru = $foto_guru->getClientOriginalName();
        $request->file('foto_guru')->move('upload_gambar', $namaFotoGuru);

        $guru = new Guru;
        $guru->nip_guru     	= $request['nip_guru'];
        $guru->nama_guru     	= $request['nama_guru'];
        $guru->ttl_guru     	= $request['ttl_guru'];
        $guru->jns_kelamin_guru = $request['jns_kelamin_guru'];
        $guru->agama_guru     	= $request['agama_guru'];
        $guru->no_telp_guru   	= $request['no_telp_guru'];
        $guru->email_guru     	= $request['email_guru'];
        $guru->alamat_guru      = $request['alamat_guru'];
        $guru->jabatan_guru     = $request['jabatan_guru'];        
        $guru->foto_guru        = $namaFotoGuru;              
        $guru->status_guru      = $request['status_guru'];                     
        $guru->id_user 			= $request['id_user'];

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $guru->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data Guru "'.$request['nip_guru'].'" - " '.$request['nama_guru'].'" Berhasil disimpan.');

        return Redirect::action('Admin\GuruController@index');
  }  

 public function editguru($nip_guru)
    {
        $data = Guru::find($nip_guru);
        $guru = Guru::orderBy('nip_guru')->get();
        $user= User::select(DB::raw("id_user, username"))
		        ->orderBy(DB::raw("id_user"))        
		        ->get();
        return view('admin.dashboard.guru.edit_guru',$data)
                ->with('userData', $user);
    }

 public function simpanedit($nip_guru)
    {
        $input =Input::all();
        $messages = [
            'nip_guru.required' 		=> 'nip guru dibutuhkan.',
            'nama_guru.required' 		=> 'nama guru dibutuhkan.',
            'ttl_guru.required' 		=> 'ttl guru dibutuhkan.', 
            'jns_kelamin_guru.required' => 'jenis kelamin guru dibutuhkan.',
            'agama_guru.required' 		=> 'agama guru dibutuhkan.',
            'no_telp_guru.required' 	=> 'no telp guru dibutuhkan.', 
            'email_guru.required' 		=> 'email guru dibutuhkan.',
            'alamat_guru.required' 		=> 'alamat guru dibutuhkan.',
            'jabatan_guru.required' 	=> 'jabatan guru dibutuhkan.', 
            'foto_guru.required' 		=> 'foto guru dibutuhkan.',
            'status_guru.required' 		=> 'status guru dibutuhkan.',  
            'id_user.required' 				=> 'id user dibutuhkan.',         
        ];
        

        $validator = Validator::make($input, [
 			'nip_guru'      	=> 'required|numeric',
            'nama_guru'  		=> 'required',
            'ttl_guru'     		=> 'required',
            'jns_kelamin_guru' 	=> 'required',
            'agama_guru'        => 'required',
            'no_telp_guru' 		=> 'required',
            'email_guru'      	=> 'required',
            'alamat_guru'  		=> 'required',
            'jabatan_guru'     	=> 'required',
            'foto_guru'      	=> 'sometimes|image:png,gif,jpeg,jpg',
            'status_guru'  		=> 'required', 
            'id_user'			=> 'required',
        ], $messages);
                     

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();          
        }
        # Bila validasi sukses
        $guru = Guru::findOrFail($nip_guru);

        // cek apakah ada file baru di form ?
        if (Input::hasFile('foto_guru')) {
        $foto_guru = $input['foto_guru'];        
        $namaFotoGuru = $foto_guru->getClientOriginalName();
        
        // cek pada atribut guru, jika ada maka hapus file lama
        if (!$guru->foto_guru == "") {
          // hapus file lama
          // $image_path = public_path().'/upload_gambar/'.$guru->foto_guru;
          // unlink($image_path);
        }          

          // upload file baru
          $input['foto_guru']->move('upload_gambar', $namaFotoGuru);
          // save data ke tabel dengan file baru
          $editGuru = Guru::find($nip_guru);
          $editGuru->nip_guru         = $input['nip_guru'];
          $editGuru->nama_guru        = $input['nama_guru'];
          $editGuru->ttl_guru         = $input['ttl_guru'];
          $editGuru->jns_kelamin_guru = $input['jns_kelamin_guru'];
          $editGuru->agama_guru       = $input['agama_guru'];
          $editGuru->no_telp_guru     = $input['no_telp_guru'];
          $editGuru->email_guru       = $input['email_guru'];
          $editGuru->alamat_guru      = $input['alamat_guru'];
          $editGuru->jabatan_guru     = $input['jabatan_guru'];
          $editGuru->foto_guru        = $namaFotoGuru;
          $editGuru->status_guru      = $input['status_guru'];              
          $editGuru->id_user          = $input['id_user'];
        } else {
          // save data ke tabel tanpa merubah dan menghapus file lama
          // $foto_guru = $siswa->foto_guru;                   
          $editGuru = Guru::find($nip_guru);
          $editGuru->nip_guru         = $input['nip_guru'];
          $editGuru->nama_guru        = $input['nama_guru'];
          $editGuru->ttl_guru         = $input['ttl_guru'];
          $editGuru->jns_kelamin_guru = $input['jns_kelamin_guru'];
          $editGuru->agama_guru       = $input['agama_guru'];
          $editGuru->no_telp_guru     = $input['no_telp_guru'];
          $editGuru->email_guru       = $input['email_guru'];
          $editGuru->alamat_guru      = $input['alamat_guru'];
          $editGuru->jabatan_guru     = $input['jabatan_guru'];            
          $editGuru->status_guru      = $input['status_guru'];              
          $editGuru->id_user          = $input['id_user']; 
        }          

        if (! $editGuru->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Guru "'.$input['nip_guru'].'" dengan nama" '.$input['nama_guru'].'" Berhasil diubah.');

        return Redirect::action('Admin\GuruController@index'); 
    }

 public function edit_asGuru()
{    
    $data = Guru::where('id_user', Auth::user()->id_user)->first(); 
    // $data = Guru::find($guru->nip_guru);
    // dd($guru, $data);
    $user= User::select(DB::raw("id_user, username"))
        ->orderBy(DB::raw("id_user"))        
        ->get();
    return view('admin.dashboard.guru.edit_guru',$data)
            ->with('userData', $user);
}

 public function simpanedit_asGuru()
    {
        $input =Input::all();
        $messages = [
            'nip_guru.required'     => 'nip guru dibutuhkan.',
            'nama_guru.required'    => 'nama guru dibutuhkan.',
            'ttl_guru.required'     => 'ttl guru dibutuhkan.', 
            'jns_kelamin_guru.required' => 'jenis kelamin guru dibutuhkan.',
            'agama_guru.required'     => 'agama guru dibutuhkan.',
            'no_telp_guru.required'   => 'no telp guru dibutuhkan.', 
            'email_guru.required'     => 'email guru dibutuhkan.',
            'alamat_guru.required'    => 'alamat guru dibutuhkan.',
            'jabatan_guru.required'   => 'jabatan guru dibutuhkan.', 
            'foto_guru.required'    => 'foto guru dibutuhkan.',
            'status_guru.required'    => 'status guru dibutuhkan.',  
            // 'id_user.required'        => 'id user dibutuhkan.',         
        ];
        

        $validator = Validator::make($input, [
            'nip_guru'        => 'required|numeric',
            'nama_guru'     => 'required',
            'ttl_guru'        => 'required',
            'jns_kelamin_guru'  => 'required',
            'agama_guru'        => 'required',
            'no_telp_guru'    => 'required',
            'email_guru'        => 'required',
            'alamat_guru'     => 'required',
            'jabatan_guru'      => 'required',
            'foto_guru'       => 'sometimes|image:png,gif,jpeg,jpg',
            'status_guru'     => 'required', 
            // 'id_user'     => 'required',
        ], $messages);
                     

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();          
        }
        # Bila validasi sukses
        $guru = Guru::findOrFail($input['nip_guru']);

        // cek apakah ada file baru di form ?
        if (Input::hasFile('foto_guru')) {
        $foto_guru = $input['foto_guru'];        
        $namaFotoGuru = $foto_guru->getClientOriginalName();
        
        // cek pada atribut guru, jika ada maka hapus file lama
        if (!$guru->foto_guru == "") {
          // hapus file lama
          // $image_path = public_path().'/upload_gambar/'.$guru->foto_guru;
          // unlink($image_path);
        }          

          // upload file baru
          $input['foto_guru']->move('upload_gambar', $namaFotoGuru);
          // save data ke tabel dengan file baru
          $editGuru = Guru::find($input['nip_guru']);          
          $editGuru->nama_guru        = $input['nama_guru'];
          $editGuru->ttl_guru         = $input['ttl_guru'];
          $editGuru->jns_kelamin_guru = $input['jns_kelamin_guru'];
          $editGuru->agama_guru       = $input['agama_guru'];
          $editGuru->no_telp_guru     = $input['no_telp_guru'];
          $editGuru->email_guru       = $input['email_guru'];
          $editGuru->alamat_guru      = $input['alamat_guru'];
          $editGuru->jabatan_guru     = $input['jabatan_guru'];
          $editGuru->foto_guru        = $namaFotoGuru; 
        } else {
          // save data ke tabel tanpa merubah dan menghapus file lama
          // $foto_guru = $siswa->foto_guru;                   
          $editGuru = Guru::find($input['nip_guru']);          
          $editGuru->nama_guru        = $input['nama_guru'];
          $editGuru->ttl_guru         = $input['ttl_guru'];
          $editGuru->jns_kelamin_guru = $input['jns_kelamin_guru'];
          $editGuru->agama_guru       = $input['agama_guru'];
          $editGuru->no_telp_guru     = $input['no_telp_guru'];
          $editGuru->email_guru       = $input['email_guru'];
          $editGuru->alamat_guru      = $input['alamat_guru'];
          $editGuru->jabatan_guru     = $input['jabatan_guru'];           
        }          

        if (! $editGuru->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Guru "'.$input['nip_guru'].'" dengan nama" '.$input['nama_guru'].'" Berhasil diubah.');

        return redirect('guru/guru/'.$input['nip_guru'].'/detail'); 
    }
  
}


