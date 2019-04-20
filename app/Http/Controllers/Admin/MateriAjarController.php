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
use App\Guru as Guru;
use App\MateriAjar as MateriAjar;
use App\MataPelajaran as MataPelajaran;
use App\Kelas as Kelas;
use Session;

class MateriAjarController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function download($id_materi_ajar)
  {
    $data = MateriAjar::find($id_materi_ajar); 
    $file = public_path()."/upload_file/".$data->materi_nama;  
    $headers = array('Content-Type: application/pdf','Content-Type: application/doc', 'Content-Type: application/docx');
    return Response::download($file, $data->materi_nama,$headers);
  }

  public function download_siswa($id_materi_ajar)
  {
    $data = MateriAjar::find($id_materi_ajar); 
    $file = public_path()."/upload_file/".$data->materi_nama;  
    $headers = array('Content-Type: application/pdf','Content-Type: application/doc', 'Content-Type: application/docx');
    return Response::download($file, $data->materi_nama,$headers);
  }

  public function download_guru($id_materi_ajar)
  {
    $data = MateriAjar::find($id_materi_ajar); 
    $file = public_path()."/upload_file/".$data->materi_nama;  
    $headers = array('Content-Type: application/pdf','Content-Type: application/doc', 'Content-Type: application/docx');
    return Response::download($file, $data->materi_nama,$headers);
  }

  public function showTambahMateriAjar()
  {
  	 $dataMapel = MataPelajaran::select(DB::raw("id_mapel, nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get();
    return view('admin.dashboard.materi_ajar.tambah_materi_ajar')
    		->with('dataMapel', $dataMapel);
  }

  public function showTambahMateriAjar_guru()
  {    
    $guru = Guru::where('id_user', Auth::user()->id_user)->first(); 
    $dataMapel = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();
    $dataKelas = DB::table('kelas_have_mata_pelajarans')                  
                 ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                 ->where('mata_pelajarans.nama_mapel', $dataMapel->nama_mapel)
                 ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get();
    return view('admin.dashboard.materi_ajar.tambah_materi_ajar')
          ->with('dataMapel', $dataMapel)
          ->with('dataKelas', $dataKelas);
  }

  public function index()
  {
    $dataMateriAjar = DB::table('materi_ajars')                                                          
       ->join('mata_pelajarans', 'materi_ajars.id_mapel', '=', 'mata_pelajarans.id_mapel')       
       ->select('materi_ajars.*', 'mata_pelajarans.nama_mapel')
       ->get();
        // dd($dataMateriAjar);    
    $data = array('materi_ajar' => $dataMateriAjar);   
    return view('admin.dashboard.materi_ajar.materi_ajar',$data);
    	   
  } 

  public function index_siswa()
  {
    $siswa = Siswa::where('id_user', Auth::user()->id_user)->first();        
    $kelas_siswa = Kelas::where('nama_kelas', $siswa->kelas_siswa)->get();
    $dataMateriAjar = DB::table('materi_ajars')                                                          
       ->join('mata_pelajarans', 'materi_ajars.id_mapel', '=', 'mata_pelajarans.id_mapel')       
       ->select('materi_ajars.*', 'mata_pelajarans.nama_mapel')
       // ->where('materi_ajars.materi_kelas', $siswa->kelas_siswa)
       ->where('materi_ajars.materi_kelas', $siswa->kelas_siswa)
       ->get();        
    $data = array('materi_ajar' => $dataMateriAjar);   
    return view('admin.dashboard.materi_ajar.materi_ajar',$data);        
  }

  public function index_guru()
  {
    $guru = Guru::where('id_user', Auth::user()->id_user)->first();        
    $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();   
    $dataMateriAjar = DB::table('materi_ajars')                                                          
       ->join('mata_pelajarans', 'materi_ajars.id_mapel', '=', 'mata_pelajarans.id_mapel')       
       ->select('materi_ajars.*', 'mata_pelajarans.nama_mapel')
       ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
       ->get();        
    $data = array('materi_ajar' => $dataMateriAjar);   
    return view('admin.dashboard.materi_ajar.materi_ajar',$data);        
  }

  public function hapus($id_materi_ajar)
  {  
    $id_materi_ajar = MateriAjar::where('id_materi_ajar', '=', $id_materi_ajar)->first();
    if ($id_materi_ajar == null)
      app::abort(404);    
    Session::flash('flash_message', 'Data Materi Ajar "'.$id_materi_ajar->materi_judul.'" - "'.$id_materi_ajar->materi_nama.'" Berhasil dihapus.');    
    $image_path = public_path().'/upload_file/'.$id_materi_ajar->materi_nama;     
    $id_materi_ajar->delete();        
    unlink($image_path);
    //File::delete(public_path()."/upload_file/".$id_materi_ajar->materi_nama);    
    return Redirect::action('Admin\MateriAjarController@index');
  }  

  public function hapus_guru($id_materi_ajar)
  {  
    $id_materi_ajar = MateriAjar::where('id_materi_ajar', '=', $id_materi_ajar)->first();
    if ($id_materi_ajar == null)
      app::abort(404);    
    Session::flash('flash_message', 'Data Materi Ajar "'.$id_materi_ajar->materi_judul.'" - "'.$id_materi_ajar->materi_nama.'" Berhasil dihapus.');    
    $image_path = public_path().'/upload_file/'.$id_materi_ajar->materi_nama;     
    $id_materi_ajar->delete();        
    unlink($image_path);
    //File::delete(public_path()."/upload_file/".$id_materi_ajar->materi_nama);    
    return Redirect::action('Admin\MateriAjarController@index_guru');
  }  
 
    
  protected function tambah(Request $request)
  {
        $input =$request->all();        
        $pesan = array(
            'materi_judul.required'     => 'Judul Materi  dibutuhkan.',  
            'materi_nama.required'      => 'Nama Materi dibutuhkan.',  
            'materi_kelas.required'      => 'Kelas Materi dibutuhkan.',
            'id_mapel.required'       => 'ID Mata Pelajaran dibutuhkan.',                      
        );

        $aturan = array(
            'materi_judul' => 'required',
            'materi_nama'  => 'required|max:20000',
            'materi_kelas'     => 'required',
            'id_mapel'     => 'required', 

        );
        

        $validator = Validator::make($input,$aturan, $pesan);        

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses
        $materi_nama = $request->file('materi_nama');
        $materi_nama_file = $materi_nama->getClientOriginalName();
        $request->file('materi_nama')->move('upload_file', $materi_nama_file);

        $materi = new MateriAjar;
        $materi->materi_judul     = $request['materi_judul'];
        $materi->materi_nama = $materi_nama_file;
        $materi->materi_kelas     = $request['materi_kelas'];
        $materi->id_mapel    = $request['id_mapel'];      

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $materi->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data Materi Ajar "'.$request['materi_judul'].'" - " '.$materi_nama_file.'" Berhasil disimpan.');

        return Redirect::action('Admin\MateriAjarController@index');
  }  

   protected function tambah_guru(Request $request)
  {
        $input =$request->all();        
        $pesan = array(
            'materi_judul.required'     => 'Judul Materi  dibutuhkan.',  
            'materi_nama.required'      => 'Nama Materi dibutuhkan.',  
            'materi_kelas.required'      => 'Kelas Materi dibutuhkan.',
            'id_mapel.required'       => 'ID Mata Pelajaran dibutuhkan.',                      
        );

        $aturan = array(
            'materi_judul' => 'required',
            'materi_nama'  => 'required|max:20000',
            'materi_kelas'     => 'required',
            'id_mapel'     => 'required', 
        );
        

        $validator = Validator::make($input,$aturan, $pesan);        

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses
        $materi_nama = $request->file('materi_nama');
        $materi_nama_file = $materi_nama->getClientOriginalName();
        $request->file('materi_nama')->move('upload_file', $materi_nama_file);

        $materi = new MateriAjar;
        $materi->materi_judul     = $request['materi_judul'];
        $materi->materi_nama = $materi_nama_file;
        $materi->materi_kelas     = $request['materi_kelas'];
        $materi->id_mapel    = $request['id_mapel'];      

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $materi->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data Materi Ajar "'.$request['materi_judul'].'" - " '.$materi_nama_file.'" Berhasil disimpan.');

        return Redirect::action('Admin\MateriAjarController@index_guru');
  } 

 public function editmateri_ajar($id_materi_ajar)
    {
        $data = MateriAjar::find($id_materi_ajar);        
        $dataMapel = MataPelajaran::select(DB::raw("id_mapel, nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get();        
        return view('admin.dashboard.materi_ajar.edit_materi_ajar',$data)
                ->with('dataMapel', $dataMapel);
    }
 
 public function editmateri_ajar_guru($id_materi_ajar)
    {
      $data = MateriAjar::find($id_materi_ajar); 
      $guru = Guru::where('id_user', Auth::user()->id_user)->first(); 
      $dataMapel = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();
      $dataKelas = DB::table('kelas_have_mata_pelajarans')                  
                   ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                   ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                   ->where('mata_pelajarans.nama_mapel', $dataMapel->nama_mapel)
                   ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get();
      return view('admin.dashboard.materi_ajar.edit_materi_ajar',$data)
            ->with('dataMapel', $dataMapel)
            ->with('dataKelas', $dataKelas);                        
    }

 public function simpanedit($id_materi_ajar)
    {
        $input =Input::all();
        $messages = [
            'materi_judul.required'     => 'Judul Materi  dibutuhkan.',  
            'materi_nama.required'      => 'Nama Materi dibutuhkan.',  
            'materi_kelas.required'      => 'Kelas Materi dibutuhkan.',
            'id_mapel.required'       => 'ID Mata Pelajaran dibutuhkan.',          
        ];
        

        $validator = Validator::make($input, [
 			      'materi_judul' => 'required',
            'materi_nama'  => 'sometimes|max:20000',
            'materi_kelas'     => 'required',
            'id_mapel'     => 'required', 
        ], $messages);



        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();          
        }
        # Bila validasi sukses        
        
        $materi_ajar = MateriAjar::findOrFail($id_materi_ajar);
        
        // cek apakah ada file baru di form ?
        if (Input::hasFile('materi_nama')) {
          $materi_nama = $input['materi_nama'];
          $materi_nama_file = $materi_nama->getClientOriginalName();        
          
          // hapus file lama
          $image_path = public_path().'/upload_file/'.$materi_ajar->materi_nama;
          unlink($image_path);        

          // upload file baru
          $input['materi_nama']->move('upload_file', $materi_nama_file); 
          // save data ke tabel dengan file baru
          $editMateriAjar = MateriAjar::find($id_materi_ajar);
          $editMateriAjar->materi_judul      = $input['materi_judul'];
          $editMateriAjar->materi_nama        = $materi_nama_file;
          $editMateriAjar->materi_kelas      = $input['materi_kelas'];
          $editMateriAjar->id_mapel           = $input['id_mapel'];
        } else {
          // save data ke tabel tanpa merubah dan menghapus file lama
          $materi_nama = $materi_ajar->materi_nama;
          
          $editMateriAjar = MateriAjar::find($id_materi_ajar);          
          $editMateriAjar->materi_judul      = $input['materi_judul']; 
          $editMateriAjar->materi_kelas      = $input['materi_kelas'];       
          $editMateriAjar->id_mapel           = $input['id_mapel']; 
        }                            

        if (! $editMateriAjar->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Materi Ajar "'.$input['materi_judul'].'" Berhasil diubah.');

        return Redirect::action('Admin\MateriAjarController@index'); 
    }


public function simpanedit_guru($id_materi_ajar)
    {
        $input =Input::all();
        $messages = [
            'materi_judul.required'     => 'Judul Materi  dibutuhkan.',  
            'materi_nama.required'      => 'Nama Materi dibutuhkan.',  
            'materi_kelas.required'      => 'Kelas Materi dibutuhkan.',
            'id_mapel.required'       => 'ID Mata Pelajaran dibutuhkan.',          
        ];
        
        $validator = Validator::make($input, [
            'materi_judul' => 'required',
            'materi_nama'  => 'sometimes|max:20000',
            'materi_kelas'     => 'required',
            'id_mapel'     => 'required', 
        ], $messages);

        if($validator->fails()) {         
            return Redirect::back()->withErrors($validator)->withInput();          
        }        
        $materi_ajar = MateriAjar::findOrFail($id_materi_ajar);        
        
        if (Input::hasFile('materi_nama')) {
          $materi_nama = $input['materi_nama'];
          $materi_nama_file = $materi_nama->getClientOriginalName();        
          
          // hapus file lama
          $image_path = public_path().'/upload_file/'.$materi_ajar->materi_nama;
          unlink($image_path);        

          // upload file baru
          $input['materi_nama']->move('upload_file', $materi_nama_file); 
          // save data ke tabel dengan file baru
          $editMateriAjar = MateriAjar::find($id_materi_ajar);
          $editMateriAjar->materi_judul      = $input['materi_judul'];
          $editMateriAjar->materi_nama        = $materi_nama_file;
          $editMateriAjar->materi_kelas      = $input['materi_kelas'];
          $editMateriAjar->id_mapel           = $input['id_mapel'];
        } else {
          // save data ke tabel tanpa merubah dan menghapus file lama
          $materi_nama = $materi_ajar->materi_nama;
          
          $editMateriAjar = MateriAjar::find($id_materi_ajar);          
          $editMateriAjar->materi_judul      = $input['materi_judul']; 
          $editMateriAjar->materi_kelas      = $input['materi_kelas'];       
          $editMateriAjar->id_mapel           = $input['id_mapel']; 
        }                            

        if (! $editMateriAjar->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Materi Ajar "'.$input['materi_judul'].'" Berhasil diubah.');

        return Redirect::action('Admin\MateriAjarController@index_guru'); 
    }
}
