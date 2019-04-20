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
use App\Tugas as Tugas;
use App\Siswa as Siswa;
use App\Guru as Guru;
use App\MataPelajaran as MataPelajaran;
use App\Kelas as Kelas;
use App\SiswaJawabTugas as SiswaJawabTugas;
use Session;

class TugasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showTambahTugas()
  {      
    if (Auth::user()->level == 11) {
     $Mapel= MataPelajaran::select(DB::raw("id_mapel, nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))        
        ->get();
    return view('admin.dashboard.tugas.tambah_tugas')
        ->with('Mapel', $Mapel);        
    }elseif (Auth::user()->level == 12) {
      $guru = Guru::where('id_user', Auth::user()->id_user)->first();        
      $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();   
      $dataKelas = DB::table('kelas_have_mata_pelajarans')                  
                 ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                 ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                 ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get();
      return view('admin.dashboard.tugas.tambah_tugas')
        ->with('dataMapel', $MapelGuru)
        ->with('dataKelas', $dataKelas);
    }
  }

  public function index()
  {           
    if (Auth::user()->level == 11) {
      $dataTugas = DB::table('tugass')                  
                 ->join('mata_pelajarans', 'tugass.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('tugass.*', 'mata_pelajarans.nama_mapel')
                 ->get();              
    }elseif (Auth::user()->level == 12) {
      $guru = Guru::where('id_user', Auth::user()->id_user)->first();        
      $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();
      $dataTugas = DB::table('tugass')                  
                 ->join('mata_pelajarans', 'tugass.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('tugass.*', 'mata_pelajarans.nama_mapel')
                 ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                 ->get();      
    }    
    $data = array('tugas' => $dataTugas);       
    return view('admin.dashboard.tugas.tugas',$data);
  }     

  public function ShowPesertaKoreksiTugas($id)
  {       
    $tugasKelas = Tugas::where('id_tugas', $id)->first()->kelas_tugas;    
    $SiswaJawabTugas = DB::table('siswa_jawab_tugas')
                        ->join('tugass', 'siswa_jawab_tugas.id_tugas', '=', 'tugass.id_tugas')
                        ->join('siswas', 'siswa_jawab_tugas.nisn_siswa', '=', 'siswas.nisn_siswa')
                        ->leftjoin('mata_pelajarans', 'tugass.id_mapel', '=', 'mata_pelajarans.id_mapel')
                        ->select('siswa_jawab_tugas.*','tugass.judul_tugas', 'tugass.kelas_tugas', 'mata_pelajarans.nama_mapel', 'mata_pelajarans.nip_guru', 'siswas.nama_siswa')
                        ->where('siswas.kelas_siswa', $tugasKelas)
                        ->get();    
    $data = array('SiswaJawabTugas' => $SiswaJawabTugas);       
    return view('admin.dashboard.tugas.peserta_koreksi_tugas',$data);
  }

  public function updateNilaiTugasSiswa($id)
    {
        $input =Input::all();  
        $messages = [
            'nilai.required'      => 'Masukkan Nilai Siswa.',                                                     
        ];        

        $validator = Validator::make($input, [
            'nilai'       => 'required',            
        ], $messages);
                     
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();          
        }
        # Bila validasi sukses
        $editSiswaJawabTugas            = SiswaJawabTugas::where('id_siswa_jawab_tugas',$id)->first();                
        $editSiswaJawabTugas->nilai     = $input['nilai'];
        if (! $editSiswaJawabTugas->save())
          App::abort(500);

        Session::flash('flash_message', 'Nilai Tugas Berhasil disimpan.');
        return Redirect::back();
    }

  public function hapus($id_tugas)
  { 
  
    $id_tugas = Tugas::where('id_tugas', '=', $id_tugas)->first();

    if ($id_tugas == null)
      app::abort(404);
    
    Session::flash('flash_message', 'Data Tugas "'.$id_tugas->judul_tugas.'" - "'.$id_tugas->info_tugas.'" Berhasil dihapus.');

    $id_tugas->delete();
    
    if (Auth::user()->level == 11) {
      return redirect('admin/tugas/');
    }elseif (Auth::user()->level == 12) {
      return redirect('guru/tugas/');
    }

  }

 public function tambah(Request $request)
    {          
          $input =$request->all();          
          
          // revisi check waktu tugas
          $wkt_selesai  = $request['wkt_selesai'];
          $wkt_sekarang = Date('Y-m-d H:i:s');                    
          if ($wkt_sekarang > $wkt_selesai) {            
                Session::flash('flash_message', 'Batas akhir pengumpulan tugas harus lebih dari waktu sekarang !!!');
                return Redirect::back(); 
          }

          $tgl_tugas_before = $request['wkt_mulai'];          
          $tgl_tugas = date ("Y-m-d", strtotime($tgl_tugas_before));
          $pesan = array(
              'judul_tugas.required' 		=> 'Judul Tugas dibutuhkan.',
              'deskripsi_tugas.required' 	=> 'Deskripsi Tugas dibutuhkan.',
              'kelas_tugas.required' 		=> 'Kelas Tugas dibutuhkan.',             
              'waktu_tugas_range.required' 		=> 'Waktu Tugas dibutuhkan.',
              'pembuat_tugas.required' 	=> 'Pembuat Tugas dibutuhkan.', 
              'info_tugas.required' 		=> 'Info Tugas dibutuhkan.',
              'status_tugas.required' 	=> 'Status Tugas dibutuhkan.', 
              'sms_status_tugas.required' => 'Status SMS Pemberitahuan Tugas Ke Siswa dibutuhkan.',
              'id_mapel.required' 		=> 'ID Mata Pelajaran dibutuhkan.',       
                       
          );

          $aturan = array(
              'judul_tugas'      	=> 'required',
              'deskripsi_tugas'  	=> 'required',
              'kelas_tugas'     	=> 'required',
              'waktu_tugas_range'       => 'required',
              'pembuat_tugas'     => 'required',
              'info_tugas'        => 'required',
              'status_tugas'  	=> 'required',
              'sms_status_tugas'  => 'required',
              'id_mapel'          => 'required',                       
          );
          
          $validator = Validator::make($input,$aturan, $pesan);

          if($validator->fails()) {
              # Kembali kehalaman yang sama dengan pesan error
              return Redirect::back()->withErrors($validator)->withInput();
          }
          # Bila validasi sukses

          $tugas = new Tugas;
          $tugas->judul_tugas         = $request['judul_tugas'];
          $tugas->deskripsi_tugas     = $request['deskripsi_tugas'];
          $tugas->kelas_tugas         = $request['kelas_tugas'];
          $tugas->waktu_tugas         = $request['waktu_tugas_range'];
          $tugas->wkt_mulai           = $request['wkt_mulai'];
          $tugas->wkt_selesai         = $request['wkt_selesai'];
          $tugas->pembuat_tugas       = $request['pembuat_tugas'];
          $tugas->tgl_tugas           = $tgl_tugas;
          $tugas->info_tugas          = $request['info_tugas'];
          $tugas->status_tugas        = $request['status_tugas'];
          $tugas->sms_status_tugas    = $request['sms_status_tugas'];
          $tugas->id_mapel            = $request['id_mapel'];              
                      
          //melakukan save, jika gagal (return value false) lakukan harakiri
          //error kode 500 - internel server error
          if (! $tugas->save() )
            App::abort(500);

          Session::flash('flash_message', 'Data Tugas'.$request['judul_tugas'].'" Berhasil disimpan.');
          
          if (Auth::user()->level == 11) {
            return redirect('admin/tugas/');
          }elseif (Auth::user()->level == 12) {
            return redirect('guru/tugas/');
          }
          
          // return Redirect::action('Admin\TugasController@index');
    }  

 public function edittugas($id_tugas)
    { 
      $data = Tugas::find($id_tugas);                
      if (Auth::user()->level == 11) {
       $Mapel= MataPelajaran::select(DB::raw("id_mapel, nama_mapel"))
          ->orderBy(DB::raw("id_mapel"))        
          ->get();
      return view('admin.dashboard.tugas.edit_tugas',$data)
          ->with('Mapel', $Mapel);        
      }elseif (Auth::user()->level == 12) {
        $guru = Guru::where('id_user', Auth::user()->id_user)->first();        
        $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();   
        $dataKelas = DB::table('kelas_have_mata_pelajarans')                  
                   ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                   ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                   ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                   ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get();
        return view('admin.dashboard.tugas.edit_tugas',$data)
          ->with('dataMapel', $MapelGuru)
          ->with('dataKelas', $dataKelas);
      }                 
    }
    

 public function simpanedit($id_tugas)
    {
        $input =Input::all();
        $tgl_tugas_before = $input['wkt_mulai'];          
        $tgl_tugas = date ("Y-m-d", strtotime($tgl_tugas_before));
        $messages = [
            'judul_tugas.required'      => 'Judul Tugas dibutuhkan.',
            'deskripsi_tugas.required'  => 'Deskripsi Tugas dibutuhkan.',
            'kelas_tugas.required'      => 'Kelas Tugas dibutuhkan.',             
            'waktu_tugas_range.required'    => 'Waktu Tugas dibutuhkan.',
            'pembuat_tugas.required'    => 'Pembuat Tugas dibutuhkan.',             
            'info_tugas.required'       => 'Info Tugas dibutuhkan.',
            'status_tugas.required'     => 'Status Tugas dibutuhkan.', 
            'sms_status_tugas.required' => 'Status SMS Pemberitahuan Tugas Ke Siswa dibutuhkan.',
            'id_mapel.required'         => 'ID Mata Pelajaran dibutuhkan.',                                           
        ];        

        $validator = Validator::make($input, [
            'judul_tugas'       => 'required',
            'deskripsi_tugas'   => 'required',
            'kelas_tugas'       => 'required',
            'waktu_tugas_range' => 'required',
            'pembuat_tugas'     => 'required',
            'info_tugas'        => 'required',
            'status_tugas'      => 'required',
            'sms_status_tugas'  => 'required',
            'id_mapel'          => 'required',            
            
        ], $messages);                    

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();          
        }
        # Bila validasi sukses
        $editTugas = Tugas::find($id_tugas);
        $editTugas->judul_tugas         = $input['judul_tugas'];
        $editTugas->deskripsi_tugas     = $input['deskripsi_tugas'];
        $editTugas->kelas_tugas         = $input['kelas_tugas'];
        $editTugas->waktu_tugas          = $input['waktu_tugas_range'];
        $editTugas->wkt_mulai           = $input['wkt_mulai'];
        $editTugas->wkt_selesai         = $input['wkt_selesai'];
        $editTugas->pembuat_tugas       = $input['pembuat_tugas'];
        $editTugas->tgl_tugas           = $tgl_tugas;
        $editTugas->info_tugas          = $input['info_tugas'];
        $editTugas->status_tugas        = $input['status_tugas'];
        $editTugas->sms_status_tugas    = $input['sms_status_tugas'];
        $editTugas->id_mapel            = $input['id_mapel'];  
        // dd($editTugas);
             
        if (! $editTugas->save())
          App::abort(500);

        Session::flash('flash_message', 'Data Tugas  dengan Judul : " '.$input['judul_tugas'].'" Berhasil diubah.');

        if (Auth::user()->level == 11) {
          return redirect('admin/tugas/');
        }elseif (Auth::user()->level == 12) {
          return redirect('guru/tugas/');
        }
        // return Redirect::action('Admin\TugasController@index'); 
    }


  public function index_siswa()
  {   
    $siswa = Siswa::where('id_user', Auth::user()->id_user)->first();
    $dataTugas = DB::table('tugass')
                 ->join('mata_pelajarans', 'tugass.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('tugass.*', 'mata_pelajarans.nama_mapel')
                 ->where('tugass.kelas_tugas', $siswa->kelas_siswa)
                 ->get();
        
    $data = array('tugas' => $dataTugas);   
    // dd($data);
    return view('admin.dashboard.tugas.tugas',$data);
  }


  // Hak Akses sebagai Siswa
  /* method detail => ketika siswa klik "Kerjakan" pada salah satu daftar tugas dalam mapel, maka akan menampilkan form upload file tugasnya
  * $id => id_tugas dari tabel tugas
  * 
  * $siswa_jawab_tugas : nisn, id_tugas, id_nilai_tugas, nama_file, nilai
  */
  public function show_detail_tugas_siswa($id)
    {           
      // $tugas = Tugas::find($id);
      $siswa = Siswa::where('id_user', Auth::user()->id_user)->first();
      $tugas = DB::table('tugass')
                   ->join('mata_pelajarans', 'tugass.id_mapel', '=', 'mata_pelajarans.id_mapel')
                   ->select('tugass.*', 'mata_pelajarans.nama_mapel')
                   ->where('tugass.id_tugas', $id)
                   ->first();
      // dd($tugas->id_tugas);
      $siswa_jawab_tugas = SiswaJawabTugas::where('id_tugas', $id)->where('nisn_siswa', $siswa->nisn_siswa)->get();
      // dd($siswa_jawab_tugas);
      if(!empty($siswa_jawab_tugas)){ 
        // $siswa_jawab_tugas = SiswaJawabTugas::where('id_tugas', $id)->where('nisn_siswa', $siswa->nisn_siswa)->first();
        $siswa_jawab_tugas = $siswa_jawab_tugas;
      }else{
        // dd('dfsdfsdfs');
        $siswa_jawab_tugas = '';
      }
           
      // dd($siswa_jawab_tugas);
      return view('admin.dashboard.tugas.detail_tugas')
              ->with('tugas', $tugas)
              ->with('siswaTugas', $siswa_jawab_tugas);  
    }

  public function tambah_tugas_siswa(Request $request)
    {
      $tugas = Tugas::find($request['id_tugas']);
      // dd($tugas);
      $wkt_selesai         = $tugas->wkt_selesai;
      $wkt_sekarang = Date('Y-m-d H:i:s');          
      //check waktu tugas
      if ($wkt_sekarang > $wkt_selesai) {            
            Session::flash('flash_message', 'Waktu mengerjakan tugas sudah habis, Anda tidak bisa mengirimkan tugas lagi');
            return Redirect::back(); 
      }else {             
            $input =$request->all();      
            $pesan = array(
                'judul.required'    => 'Judul dibutuhkan.',
                'nama_file.required'    => 'File Tugas dibutuhkan.',                                                 
            );

            $aturan = array(
                'judul'       => 'required',
                'nama_file'   => 'required|max:10000',                                
            );
            
            $validator = Validator::make($input,$aturan, $pesan);

            if($validator->fails()) {
                # Kembali kehalaman yang sama dengan pesan error
                return Redirect::back()->withErrors($validator)->withInput();
            }
            # Bila validasi sukses

            $nama_file = $request->file('nama_file');
            // dd($nama_file);
            $nama_file_tugas = $nama_file->getClientOriginalName();
            $request->file('nama_file')->move('file_tugas_siswa', $nama_file_tugas);        

            $tugasSiswa = new SiswaJawabTugas;
            $tugasSiswa->judul        = $input['judul'];
            $tugasSiswa->nama_file    = $nama_file_tugas;
            $tugasSiswa->id_tugas     = $input['id_tugas'];
            $tugasSiswa->nisn_siswa   = Siswa::where('id_user', Auth::user()->id_user)->first()->nisn_siswa;
            $tugasSiswa->nilai        = 0;
            
            if (! $tugasSiswa->save() )
              App::abort(500);

            Session::flash('flash_message', 'File tugas kamu berhasil disimpan.');
            return redirect('siswa/tugas/'.$input['id_tugas'].'/detail_tugas_siswa');
            // return Redirect::action('Admin\TugasController@show_detail_tugas_siswa'); 
      }        
    }

  public function hapus_tugas_siswa($id)
    {    
      $id_siswa_jawab_tugas = SiswaJawabTugas::where('id_siswa_jawab_tugas', '=', $id)->first();
      $id_tugas = $id_siswa_jawab_tugas->id_tugas;
      if ($id_siswa_jawab_tugas == null)
        app::abort(404);
      
      Session::flash('flash_message', 'File tugas kamu berhasil dihapus.');
      
      $image_path = public_path().'/file_tugas_siswa/'.$id_siswa_jawab_tugas->nama_file; 
      
      $id_siswa_jawab_tugas->delete();    
      
      unlink($image_path);
      return redirect('siswa/tugas/'.$id_tugas.'/detail_tugas_siswa');    
    }

  public function download_tugas_siswa($id)
    {
      $data = SiswaJawabTugas::find($id); 
      $file = public_path()."/file_tugas_siswa/".$data->nama_file;  
      $headers = array('Content-Type: application/pdf','Content-Type: application/doc', 'Content-Type: application/docx');
      return Response::download($file, $data->nama_file,$headers);
    }
} // end code

