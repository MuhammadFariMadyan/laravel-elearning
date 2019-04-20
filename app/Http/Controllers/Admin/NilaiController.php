<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Session;
use Response;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\SiswaJawabTugas as NilaiTugas; // tabel nilai tugas siswa
use App\NilaiUjianPilihanGandaSiswa as NilaiUjian; 
use App\MataPelajaran as MataPelajaran;
use App\Tugas as Tugas;
use App\Kelas as Kelas;
use App\Ujian as Ujian;
use App\Siswa as Siswa;
use App\Guru as Guru;

class NilaiController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showTambahNilai()
  {
  	$idSiswa= Siswa::select(DB::raw("nisn_siswa, nama_siswa"))
        ->orderBy(DB::raw("nisn_siswa"))        
        ->get();
    $idNilaiTugas= NilaiTugas::select(DB::raw("id_nilai_tugas_siswa,nisn_siswa"))
        ->orderBy(DB::raw("id_nilai_tugas_siswa"))        
        ->get();
    $idNilaiUjian= NilaiUjian::select(DB::raw("id_nilai_ujian_siswa,nisn_siswa"))
        ->orderBy(DB::raw("id_nilai_ujian_siswa"))        
        ->get();
    // dd($data);        
    return view('admin.dashboard.nilai.tambah_nilai')
    		->with('Siswa', $idSiswa)
        ->with('NilaiTugas', $idNilaiTugas)
        ->with('NilaiUjian', $idNilaiUjian);
  }

  public function index()
    {                
    if (Auth::user()->level == 11) {
      $dataNilai = DB::table('nilai_siswas')   
                 ->join('nilai_ujian_siswas', 'nilai_siswas.id_nilai_ujian_siswa', '=', 'nilai_ujian_siswas.id_nilai_ujian_siswa') 
                 ->leftjoin('mata_pelajarans','nilai_ujian_siswas.id_mapel','=','mata_pelajarans.id_mapel')                                                
                 ->join('nilai_tugas_siswas', 'nilai_siswas.id_nilai_tugas_siswa', '=', 'nilai_tugas_siswas.id_nilai_tugas_siswa')
                 ->join('siswas', 'nilai_siswas.nisn_siswa', '=', 'siswas.nisn_siswa')
                 ->select('nilai_siswas.*', 'siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'nilai_ujian_siswas.nilai_ujian', 'nilai_tugas_siswas.nilai_tugas')
                 ->get();              
    }elseif (Auth::user()->level == 12) {
      $guru = Guru::where('id_user', Auth::user()->id_user)->first();        
      $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();      
      $dataNilai = DB::table('nilai_siswas')   
                 ->join('nilai_ujian_siswas', 'nilai_siswas.id_nilai_ujian_siswa', '=', 'nilai_ujian_siswas.id_nilai_ujian_siswa') 
                 ->leftjoin('mata_pelajarans','nilai_ujian_siswas.id_mapel','=','mata_pelajarans.id_mapel')                                                
                 ->join('nilai_tugas_siswas', 'nilai_siswas.id_nilai_tugas_siswa', '=', 'nilai_tugas_siswas.id_nilai_tugas_siswa')
                 ->join('siswas', 'nilai_siswas.nisn_siswa', '=', 'siswas.nisn_siswa')
                 ->select('nilai_siswas.*', 'siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'nilai_ujian_siswas.nilai_ujian', 'nilai_tugas_siswas.nilai_tugas')
                 ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                 ->get();             
    }
        
    $data = array('nilai' => $dataNilai);   
     // dd($data);
    return view('admin.dashboard.nilai.nilai',$data);
    }    
  public function hapus($id_nilai_siswa)
    {   
      $id_nilai_siswa = Nilai::where('id_nilai_siswa', '=', $id_nilai_siswa)->first();
      if ($id_nilai_siswa == null)
        app::abort(404);    
      Session::flash('flash_message', 'Data Nilai "'.$id_nilai_siswa->nisn_siswa.'" Berhasil dihapus.');
      $id_nilai_siswa->delete();    
      if (Auth::user()->level == 11) {
        return redirect('admin/nilai_siswa/');
      }elseif (Auth::user()->level == 12) {
        return redirect('guru/nilai_siswa/');
      }
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
          	'nisn_siswa.required' 		      => 'NISN Siswa dibutuhkan.',
            'id_nilai_tugas_siswa.required' => 'ID Nilai Tugas dibutuhkan.',            
            'id_nilai_ujian_siswa.required' => 'ID Nilai Ujian dibutuhkan.',                                                  
        );

        $aturan = array(
            'nisn_siswa'  		      => 'required',
            'id_nilai_tugas_siswa'  => 'required',            
            'id_nilai_ujian_siswa'  => 'required',                                  
        );        
        $validator = Validator::make($input,$aturan, $pesan);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nilai = new Nilai;
        $nilai->nisn_siswa     	= $request['nisn_siswa'];
        $nilai->id_nilai_tugas_siswa     	= $request['id_nilai_tugas_siswa'];
        $nilai->id_nilai_ujian_siswa     	= $request['id_nilai_ujian_siswa'];                  
                    
        if (! $nilai->save() )
          App::abort(500);
        Session::flash('flash_message', 'Data Nilai "'.$request['nisn_siswa'].'" Berhasil disimpan.');
        if (Auth::user()->level == 11) {
          return redirect('admin/nilai_siswa/');
        }elseif (Auth::user()->level == 12) {
          return redirect('guru/nilai_siswa/');
        }
    }  

  // Admin melihat nilai siswa berdasarkan kelas
  public function showKelasNilai(Request $request) 
  {
    if (Auth::user()->level == 11) {
      $listKelas = array('VII A', 'VII B', 'VII C', 'VIII A', 'VIII B', 'VIII C', 'IX A', 'IX B');
    }elseif (Auth::user()->level == 12) {
      $guru = Guru::where('id_user', Auth::user()->id_user)->first();
      $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();
      $listKelas = DB::table('kelas_have_mata_pelajarans')                  
                 ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('kelas_have_mata_pelajarans.nama_kelas')
                 ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                 ->orderBy('kelas_have_mata_pelajarans.id', 'asc')->get(); 

    }        
    if(!empty($kelas_terpilih = $request->get('kelas_terpilih'))){
      $kelas_terpilih = $request->get('kelas_terpilih');                  
    }else {
      $kelas_terpilih = '';        
    }

    $nilaiTugas = DB::table('siswa_jawab_tugas')   
           ->join('tugass', 'siswa_jawab_tugas.id_tugas', '=', 'tugass.id_tugas') 
           ->join('siswas', 'siswa_jawab_tugas.nisn_siswa', '=', 'siswas.nisn_siswa')
           ->leftjoin('mata_pelajarans','tugass.id_mapel','=','mata_pelajarans.id_mapel')
           ->leftjoin('gurus','mata_pelajarans.nip_guru','=','gurus.nip_guru')
           ->select('siswa_jawab_tugas.*', 'siswas.nisn_siswa','siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'tugass.*', 'gurus.nip_guru','gurus.nama_guru')
           ->where('tugass.kelas_tugas', $kelas_terpilih)
           ->get();
      $nilaiUjian = DB::table('nilai_ujian_pilgan_siswas')   
           ->join('ujians', 'nilai_ujian_pilgan_siswas.id_ujian', '=', 'ujians.id_ujian') 
           ->join('siswas', 'nilai_ujian_pilgan_siswas.nisn_siswa', '=', 'siswas.nisn_siswa')
           ->leftjoin('mata_pelajarans','ujians.id_mapel','=','mata_pelajarans.id_mapel')
           ->leftjoin('gurus','mata_pelajarans.nip_guru','=','gurus.nip_guru')
           ->select('nilai_ujian_pilgan_siswas.*', 'siswas.nisn_siswa','siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'ujians.*', 'gurus.nip_guru','gurus.nama_guru')
           ->where('ujians.kelas_ujian', $kelas_terpilih)
           ->get();
    return view('admin.dashboard.nilai.nilai') 
            ->with('listKelas', $listKelas)
            ->with('kelas_terpilih', $kelas_terpilih)
            ->with('nilaiTugas', $nilaiTugas)
            ->with('nilaiUjian', $nilaiUjian);

  }

  // Admin melihat nilai siswa berdasarkan kelas
  public function showSiswaKelasNilai(Request $request) 
  {
    $siswa = Siswa::where('id_user', Auth::user()->id_user)->first();
    $listMapel = Kelas::select(DB::raw("id, nama_kelas, mata_pelajarans.id_mapel, mata_pelajarans.nama_mapel, mata_pelajarans.nip_guru"))   
                  ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                  ->where('nama_kelas', $siswa->kelas_siswa)->get();

    // dd($siswa->kelas_siswa,$request->get('mapel_terpilih'));

    if(!empty($mapel_terpilih = $request->get('mapel_terpilih'))){
      $mapel_terpilih = $request->get('mapel_terpilih');  
          
      $nilaiTugas = DB::table('siswa_jawab_tugas')   
           ->join('tugass', 'siswa_jawab_tugas.id_tugas', '=', 'tugass.id_tugas') 
           ->join('siswas', 'siswa_jawab_tugas.nisn_siswa', '=', 'siswas.nisn_siswa')
           ->leftjoin('mata_pelajarans','tugass.id_mapel','=','mata_pelajarans.id_mapel')
           ->leftjoin('gurus','mata_pelajarans.nip_guru','=','gurus.nip_guru')
           ->select('siswa_jawab_tugas.*', 'siswas.nisn_siswa','siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'tugass.*', 'gurus.nip_guru','gurus.nama_guru')
           ->where('tugass.kelas_tugas', $siswa->kelas_siswa)
           ->where('mata_pelajarans.nama_mapel', $mapel_terpilih)
           ->where('siswa_jawab_tugas.nisn_siswa', $siswa->nisn_siswa)
           ->get();
      $nilaiUjian = DB::table('nilai_ujian_pilgan_siswas')   
           ->join('ujians', 'nilai_ujian_pilgan_siswas.id_ujian', '=', 'ujians.id_ujian') 
           ->join('siswas', 'nilai_ujian_pilgan_siswas.nisn_siswa', '=', 'siswas.nisn_siswa')
           ->leftjoin('mata_pelajarans','ujians.id_mapel','=','mata_pelajarans.id_mapel')
           ->leftjoin('gurus','mata_pelajarans.nip_guru','=','gurus.nip_guru')
           ->select('nilai_ujian_pilgan_siswas.*', 'siswas.nisn_siswa','siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'ujians.*', 'gurus.nip_guru','gurus.nama_guru')
           ->where('ujians.kelas_ujian', $siswa->kelas_siswa)
           ->where('mata_pelajarans.nama_mapel', $mapel_terpilih)
           ->where('nilai_ujian_pilgan_siswas.nisn_siswa', $siswa->nisn_siswa)  
           ->get();

    }else {
      $mapel_terpilih = '';  
      $nilaiTugas = DB::table('siswa_jawab_tugas')   
           ->join('tugass', 'siswa_jawab_tugas.id_tugas', '=', 'tugass.id_tugas') 
           ->join('siswas', 'siswa_jawab_tugas.nisn_siswa', '=', 'siswas.nisn_siswa')
           ->leftjoin('mata_pelajarans','tugass.id_mapel','=','mata_pelajarans.id_mapel')
           ->leftjoin('gurus','mata_pelajarans.nip_guru','=','gurus.nip_guru')
           ->select('siswa_jawab_tugas.*', 'siswas.nisn_siswa','siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'tugass.*', 'gurus.nip_guru','gurus.nama_guru')
           ->where('tugass.kelas_tugas', $siswa->kelas_siswa)
           ->where('mata_pelajarans.nama_mapel', $mapel_terpilih)
           ->where('siswa_jawab_tugas.nisn_siswa', $siswa->nisn_siswa)
           ->get();
      $nilaiUjian = DB::table('nilai_ujian_pilgan_siswas')   
           ->join('ujians', 'nilai_ujian_pilgan_siswas.id_ujian', '=', 'ujians.id_ujian') 
           ->join('siswas', 'nilai_ujian_pilgan_siswas.nisn_siswa', '=', 'siswas.nisn_siswa')
           ->leftjoin('mata_pelajarans','ujians.id_mapel','=','mata_pelajarans.id_mapel')
           ->leftjoin('gurus','mata_pelajarans.nip_guru','=','gurus.nip_guru')
           ->select('nilai_ujian_pilgan_siswas.*', 'siswas.nisn_siswa','siswas.nama_siswa', 'mata_pelajarans.nama_mapel', 'ujians.*', 'gurus.nip_guru','gurus.nama_guru')
           ->where('ujians.kelas_ujian', $siswa->kelas_siswa)
           ->where('mata_pelajarans.nama_mapel', $mapel_terpilih)
           ->where('nilai_ujian_pilgan_siswas.nisn_siswa', $siswa->nisn_siswa)
           ->get();
    }

    return view('admin.dashboard.nilai.detail_nilai_siswa') 
                ->with('siswa', $siswa)
                ->with('listMapel', $listMapel)
                ->with('mapel_terpilih', $mapel_terpilih)
                ->with('nilaiTugas', $nilaiTugas)
                ->with('nilaiUjian', $nilaiUjian);

  }
} 
