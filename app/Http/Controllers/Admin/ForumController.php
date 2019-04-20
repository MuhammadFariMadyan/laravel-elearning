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
use App\Forum as Forum;
use App\Tugas as Tugas;
use App\Siswa as Siswa;
use App\Guru as Guru;
use App\Pengumuman as Pengumuman;
use Session;

class ForumController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  // guru
  public function index_guru()
  {
    $dataPengumuman = Pengumuman::select(DB::raw("id_pengumuman, judul, deskripsi, author"))
        ->orderBy(DB::raw("id_pengumuman"))        
        ->get();
        
    $data = array('pengumuman' => $dataPengumuman);   
    return view('admin.dashboard.pengumuman.pengumuman',$data);
  }  

  // siswa
  public function index_siswa($id_tugas)
  {    
    $dataTugas = DB::table('tugass')
                 ->join('mata_pelajarans', 'tugass.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('tugass.*', 'mata_pelajarans.nama_mapel')
                 ->where('id_tugas', $id_tugas)
                 ->first();    
    $dataForum = Forum::where('id_tugas', $id_tugas)->get();

    if (Auth::user()->level == 13) {
        $siswa = Siswa::where('id_user', Auth::user()->id_user)->first();
        $tgl_forum = date('Y-m-d');      
        return view('admin.dashboard.forum.forum_siswa')
            ->with('tgl_forum', $tgl_forum)
            ->with('dataForum', $dataForum)
            ->with('nisn_siswa', $siswa->nisn_siswa)
            ->with('tugas', $dataTugas);
    }
    if (Auth::user()->level == 12) {
        $guru = Guru::where('id_user', Auth::user()->id_user)->first();   
        $tgl_forum = date('Y-m-d');
        return view('admin.dashboard.forum.forum_siswa')
            ->with('tgl_forum', $tgl_forum)
            ->with('dataForum', $dataForum)
            ->with('nip_guru', $guru->nip_guru)
            ->with('tugas', $dataTugas);
    }    
        
  }   
 
  protected function tambah(Request $request)
  {
        $input =$request->all();
        $pesan = array(
            'komentar.required' => 'Isi Dahulu Pesan kamu.',                     
        );

        $aturan = array(
            'komentar'      => 'required'            
        );      
        $validator = Validator::make($input,$aturan, $pesan);        
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses
        $forum = new Forum;
        $forum->id_tugas     = $request['id_tugas'];              
        $forum->nip_guru     = $request['nip_guru'];              
        $forum->nisn_siswa     = $request['nisn_siswa'];              
        $forum->komentar     = $request['komentar'];              
        $forum->tgl_forum     = date('Y-m-d');                           
        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $forum->save() )
          App::abort(500);
        return Redirect::back();
        // return Redirect::action('Admin\ForumController@index_siswa');
  }  
}
