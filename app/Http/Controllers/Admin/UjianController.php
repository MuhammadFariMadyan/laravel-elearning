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
use App\Ujian as Ujian;
use App\Soal as Soal;
use App\Siswa as Siswa;
use App\Guru as Guru;
use App\MataPelajaran as MataPelajaran;
use App\SiswaJawabUjianPilihanGanda as SiswaJawabUjianPilihanGanda;
use App\NilaiUjianPilihanGandaSiswa as NilaiUjianPilihanGandaSiswa;
use App\JawabanSoalUjian as JawabanSoalUjian;
use App\SoalHasUjian as SoalHasUjian;
use Session;

class UjianController extends Controller
{
public function __construct()
  {
    $this->middleware('auth');
  }

public function showTambahUjian()
  {
    if (Auth::user()->level == 11) {
     $Mapel= MataPelajaran::select(DB::raw("id_mapel, nama_mapel"))
        ->orderBy(DB::raw("id_mapel"))
        ->get();

    return view('admin.dashboard.ujian.tambah_ujian')
        ->with('Mapel', $Mapel);

    }elseif (Auth::user()->level == 12) {
      $guru = Guru::where('id_user', Auth::user()->id_user)->first();
      $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();
      $dataKelas = DB::table('kelas_have_mata_pelajarans')
                 ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                 ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                 ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get();
      return view('admin.dashboard.ujian.tambah_ujian')
        ->with('dataMapel', $MapelGuru)
        ->with('dataKelas', $dataKelas);
    }
  }

public function detail($id_ujian)
  {
    $data = Ujian::find($id_ujian);
    $ujian = Ujian::orderBy('id_ujian')->get();
    $dataUjian = DB::table('ujians')
                 ->join('mata_pelajarans', 'ujians.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('ujians.*', 'mata_pelajarans.nama_mapel')
                 ->where('ujians.id_ujian', $id_ujian)
                 ->first();

    // dd($dataUjian);
    // revisi check waktu ujian
    $wkt_ujian  = $dataUjian->tgl_ujian;
    $wkt_sekarang = Date('Y-m-d');
    if ($wkt_sekarang > $wkt_ujian) {
          Session::flash('flash_message', 'Batas akhir ujian Sudah Berakhir !!! Hubungi guru anda.');
          return Redirect::back();
    }

    $dataSoalUjianDetail = DB::table('soals')
         ->join('ujians', 'soals.id_ujian', '=', 'ujians.id_ujian')
         ->leftjoin('mata_pelajarans','ujians.id_mapel','=','mata_pelajarans.id_mapel')
         ->leftjoin('gurus','mata_pelajarans.nip_guru','=','gurus.nip_guru')
         ->select('soals.*', 'ujians.*', 'mata_pelajarans.nama_mapel', 'gurus.nama_guru')
         ->where('soals.id_ujian', $id_ujian)
         ->get();

    $dataJawabanSoal = DB::table('jawaban_soal_ujians')
         ->join('soals','jawaban_soal_ujians.id_soal','=','soals.id_soal')
         ->leftjoin('ujians', 'soals.id_ujian', '=', 'ujians.id_ujian')
         ->select('jawaban_soal_ujians.poin', 'jawaban_soal_ujians.id_soal')
         ->get();

    $maxPoint = 0;
    foreach ($dataJawabanSoal as $jawaban){
        if ($jawaban->poin > $maxPoint)
            (int)$maxPoint = $jawaban->poin;
        }

    $countSoalPilgan   = Soal::where('jenis_soal', '=', 'Pilihan Ganda')->where('id_ujian', '=', $id_ujian)->count();
    $countSoalEssay   = Soal::where('jenis_soal', '=', 'Essay')->where('id_ujian', '=', $id_ujian)->count();
    $countSoalDetail   = Soal::where('id_ujian', '=', $id_ujian)->count();

    // dd($countSoalDetail);
    return view('admin.dashboard.ujian.detail_ujian', $data)
            ->with('countSoalPilgan', $countSoalPilgan)
            ->with('countSoalEssay', $countSoalEssay)
            ->with('countSoalDetail', $countSoalDetail)
            ->with('soal_ujian', $dataSoalUjianDetail)
            ->with('poin', $maxPoint)
            ->with('ujian', $dataUjian);
  }

public function index()
  {
    if (Auth::user()->level == 11) {
      $dataUjian = DB::table('ujians')
                 ->join('mata_pelajarans', 'ujians.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('ujians.*', 'mata_pelajarans.nama_mapel')
                 ->get();
    }elseif (Auth::user()->level == 12) {
      $guru = Guru::where('id_user', Auth::user()->id_user)->first();
      $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();
      $dataUjian = DB::table('ujians')
                 ->join('mata_pelajarans', 'ujians.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('ujians.*', 'mata_pelajarans.nama_mapel')
                 ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                 ->get();
    }
    $data = array('ujian' => $dataUjian);
    return view('admin.dashboard.ujian.ujian',$data);
  }

  // daftar ujian siswa dan daftar pengambilan ujian siswa
public function index_siswa()
  {
    $id_user = Auth::user()->id_user;
    $siswa = Siswa::where('id_user',$id_user)->first();
    $nisn = $siswa->nisn_siswa;

    $dataUjian = DB::table('ujians')
                 ->join('mata_pelajarans', 'ujians.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('ujians.*', 'mata_pelajarans.nama_mapel')
                 ->where('kelas_ujian', $siswa->kelas_siswa)
                 ->where('status_ujian', 'Aktif')
                 ->get();

    $data = array('ujianSiswa' => $dataUjian);

    $countUjianSiswa   = Ujian::where('kelas_ujian', $siswa->kelas_siswa)->get()->count(); // berdasarkan kelas nya siswa masing masing

    $userJawabLembar = NilaiUjianPilihanGandaSiswa::whereRaw('nisn_siswa = ?', array($nisn))->orderBy('id_nilai_ujian_pilgan', 'desc')->get();
    $userJawabLembars = DB::table('nilai_ujian_pilgan_siswas')
                 ->join('ujians', 'nilai_ujian_pilgan_siswas.id_ujian', '=', 'ujians.id_ujian')
                 ->select('ujians.judul_ujian', 'ujians.jenis_ujian', 'ujians.tgl_ujian', 'nilai_ujian_pilgan_siswas.*')
                 ->whereRaw('nisn_siswa = ?', array($nisn))->orderBy('id_nilai_ujian_pilgan', 'desc')->get();
    // new
    // $soals = Soal::orderBy('updated_at', 'desc')->get();

    return view('admin.dashboard.ujian.ujian',$data)
            ->with('siswa', $siswa)
            ->with('userJawabLembars', $userJawabLembar)
            ->with('countUjian', $countUjianSiswa);
  }

public function hapus($id_ujian)
  {

    $id_ujian = Ujian::where('id_ujian', '=', $id_ujian)->first();
//dd($id_ujian);
    if ($id_ujian == null)
      \app::abort(404);

    Session::flash('flash_message', 'Data Ujian "'.$id_ujian->judul_ujian.'" - "'.$id_ujian->info_ujian.'" Berhasil dihapus.');

    $id_ujian->delete();

    if (Auth::user()->level == 11) {
      return redirect('admin/ujian/');
    }elseif (Auth::user()->level == 12) {
      return redirect('guru/ujian/');
    }
  }

public function tambah(Request $request)
  {
        $input =$request->all();
        // revisi check waktu ujian
        $wkt_ujian  = $request['tgl_ujian'];
        $wkt_sekarang = Date('Y-m-d');
        if ($wkt_sekarang > $wkt_ujian) {
              Session::flash('flash_message', 'Tanggal ujian harus lebih dari waktu sekarang !!!');
              return Redirect::back();
        }

        $pesan = array(
        	'jenis_ujian.required' 		  => 'Jenis Ujian dibutuhkan.',
            'judul_ujian.required'      => 'Judul Ujian dibutuhkan.',
            'kelas_ujian.required'      => 'Kelas Ujian dibutuhkan.',
            'waktu_ujian.required'      => 'Batas Waktu Ujian dibutuhkan.',
            'jumlah_soal.required'            => 'Jumlah Soal dibutuhkan.',
            // 'is_random.required'        => ' dibutuhkan.',
            'pembuat_ujian.required'    => 'Pembuat Ujian dibutuhkan.',
            'tgl_ujian.required'        => 'Tanggal Ujian dibutuhkan.',
            'info_ujian.required'       => 'Info Ujian dibutuhkan.',
            'status_ujian.required'     => 'Status Ujian dibutuhkan.',
            'id_mapel.required'         => 'ID Mata Pelajaran dibutuhkan.',

        );

        $aturan = array(
            'jenis_ujian'       => 'required',
            'judul_ujian'       => 'required',
            'kelas_ujian'       => 'required',
            'waktu_ujian'       => 'required|numeric|min:1',
            'jumlah_soal'       => 'required|numeric|min:1',
            // 'is_random'         => 'required',
            'pembuat_ujian'     => 'required',
            'tgl_ujian'         => 'required',
            'info_ujian'        => 'required',
            'status_ujian'      => 'required',
            'id_mapel'          => 'required',

        );


        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses

        $ujian = new Ujian;
        $ujian->jenis_ujian       = $request['jenis_ujian'];
        $ujian->judul_ujian     	= $request['judul_ujian'];
        $ujian->kelas_ujian     	= $request['kelas_ujian'];
        $ujian->waktu_ujian     	= $request['waktu_ujian'];
        $ujian->jumlah_soal       = $request['jumlah_soal'];
        $ujian->is_random         = $request['is_random'];
        $ujian->pembuat_ujian     = $request['pembuat_ujian'];
        $ujian->tgl_ujian         = $request['tgl_ujian'];
        $ujian->info_ujian     	  = $request['info_ujian'];
        $ujian->status_ujian     	= $request['status_ujian'];
        $ujian->id_mapel     	    = $request['id_mapel'];

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $ujian->save() )
          App::abort(500);

        Session::flash('flash_message', 'Data "'.$request['jenis_ujian'].'" - " '.$request['judul_ujian'].'" Berhasil disimpan.');

        if (Auth::user()->level == 11) {
          return redirect('admin/ujian/');
        }elseif (Auth::user()->level == 12) {
          return redirect('guru/ujian/');
        }
  }

public function editujian($id_ujian)
    {
      $data = Ujian::find($id_ujian);
      if (Auth::user()->level == 11) {
       $Mapel= MataPelajaran::select(DB::raw("id_mapel, nama_mapel"))
          ->orderBy(DB::raw("id_mapel"))
          ->get();
      return view('admin.dashboard.ujian.edit_ujian',$data)
          ->with('Mapel', $Mapel);
      }elseif (Auth::user()->level == 12) {
        $guru = Guru::where('id_user', Auth::user()->id_user)->first();
        $MapelGuru = MataPelajaran::where('nip_guru', $guru->nip_guru)->first();
        $dataKelas = DB::table('kelas_have_mata_pelajarans')
                   ->join('mata_pelajarans', 'kelas_have_mata_pelajarans.id_mapel', '=', 'mata_pelajarans.id_mapel')
                   ->select('kelas_have_mata_pelajarans.*', 'mata_pelajarans.nama_mapel')
                   ->where('mata_pelajarans.nama_mapel', $MapelGuru->nama_mapel)
                   ->orderBy('kelas_have_mata_pelajarans.nama_kelas', 'asc')->get();
        return view('admin.dashboard.ujian.edit_ujian',$data)
          ->with('dataMapel', $MapelGuru)
          ->with('dataKelas', $dataKelas);
      }
    }

public function simpanedit($id_ujian)
    {
        $input =Input::all();
        $messages = [
            'jenis_ujian.required'      => 'Jenis Ujian dibutuhkan.',
            'judul_ujian.required'      => 'Judul Ujian dibutuhkan.',
            'kelas_ujian.required'      => 'Kelas Ujian dibutuhkan.',
            'waktu_ujian.required'      => 'Batas Waktu Ujian dibutuhkan.',
            'jumlah_soal.required'            => 'Jumlah Soal dibutuhkan.',
            // 'is_random.required'        => ' dibutuhkan.',
            'pembuat_ujian.required'    => 'Pembuat Ujian dibutuhkan.',
            'tgl_ujian.required'        => 'Tanggal Ujian dibutuhkan.',
            'info_ujian.required'       => 'Info Ujian dibutuhkan.',
            'status_ujian.required'     => 'Status Ujian dibutuhkan.',
            'id_mapel.required'         => 'ID Mata Pelajaran dibutuhkan.',
        ];

        $validator = Validator::make($input, [
            'jenis_ujian'       => 'required',
            'judul_ujian'       => 'required',
            'kelas_ujian'       => 'required',
            'waktu_ujian'       => 'required',
            'jumlah_soal'       => 'required',
            // 'is_random'         => 'required',
            'pembuat_ujian'     => 'required',
            'tgl_ujian'         => 'required',
            'info_ujian'        => 'required',
            'status_ujian'      => 'required',
            'id_mapel'          => 'required',
        ], $messages);


        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
        }
        # Bila validasi sukses
        $editUjian = Ujian::find($id_ujian);
        $editUjian->jenis_ujian       = $input['jenis_ujian'];
        $editUjian->judul_ujian     	= $input['judul_ujian'];
        $editUjian->kelas_ujian     	= $input['kelas_ujian'];
        $editUjian->waktu_ujian     	= $input['waktu_ujian'];
        $editUjian->jumlah_soal       = (int)Input::get('jumlah_soal');
        $editUjian->is_random         = (int)Input::get('is_random');
        $editUjian->pembuat_ujian     = $input['pembuat_ujian'];
        $editUjian->tgl_ujian         = $input['tgl_ujian'];
        $editUjian->info_ujian     	  = $input['info_ujian'];
        $editUjian->status_ujian     	= $input['status_ujian'];
        $editUjian->id_mapel     	    = $input['id_mapel'];

        if (! $editUjian->save())
          App::abort(500);

        Session::flash('flash_message', 'Data : " '.$input['judul_ujian'].'" Berhasil diubah.');

        if (Auth::user()->level == 11) {
          return redirect('admin/ujian/');
        }elseif (Auth::user()->level == 12) {
          return redirect('guru/ujian/');
        }
    }

     /**
     * Method store siswa jawab ujian : pilihan ganda
     *
     * @return Response
     */
    public function store_siswa()
    {
        $id_ujian = Input::all();
        // dd($id_ujian);
        $siswa = Siswa::where('id_user', Auth::user()->id_user)->first(); // Auth::user()->id_user
        $ujian = Ujian::find($id_ujian['id_ujian']);


        try {
            DB::beginTransaction();
            if (!$id_ujian){
              Session::flash('flash_message', 'Ujian yang kamu pilih tidak ditemukan');
              return Redirect::back();
            }

            if (!$ujian){
              Session::flash('flash_message', 'Ujian tidak ditemukan');
              return Redirect::back();
            }

            $nilaiUjianPilganSiswa = NilaiUjianPilihanGandaSiswa::whereRaw('nisn_siswa = ? and id_ujian = ?', array($siswa->nisn_siswa, $ujian->id_ujian))->get();

            if (!$nilaiUjianPilganSiswa->isEmpty()){
              Session::flash('flash_message', 'Anda sudah pernah mengambil ujian ini, periksa kembali pada Daftar Pengambilan ujian di Menu Ujian, atau hubungi Admin untuk informasi lebih lanjut');
              return Redirect::back();
            }

            // proses penyimpanan data ujian siswa, dengan nilai sementara pada saat waktu ujian di mulai.
            $nilaiUjianPilganSiswa              = new NilaiUjianPilihanGandaSiswa;
            $nilaiUjianPilganSiswa->id_ujian    = $ujian->id_ujian;
            $nilaiUjianPilganSiswa->nisn_siswa  = Siswa::where('id_user', Auth::user()->id_user)->first()->nisn_siswa;
            $nilaiUjianPilganSiswa->wkt_mulai   = date('Y-m-d H:i:s');
            $nilaiUjianPilganSiswa->nilai       = 0; //nilai sementara //(4 * 0) - (2 * 0) - $ujian->jumlah_soal + (int)$ujian->waktu_ujian;
            $nilaiUjianPilganSiswa->save();

            // Acak Soal
            // Jika Acak Soal = Ya , maka urutan soal berdasarkan "id_soal" akan di acak dengan 'RAND' -> Random
            // Selain itu, maka soal akan diurutkan berdasarkan waktu pembuatan nya scr ascending
            if ($ujian->is_random) {
                $soalIds = SoalHasUjian::where('id_ujian', $ujian->id_ujian)->orderBy(DB::raw('RAND()'))->limit($ujian->jumlah_soal)->pluck('id_soal');
            } else {
                $soalIds = SoalHasUjian::where('id_ujian', $ujian->id_ujian)->orderBy('soal_has_ujians.created_at', 'asc')->limit($ujian->jumlah_soal)->pluck('id_soal');
            }

            foreach ($soalIds as $soalId) {
                $userJawab                           = new SiswaJawabUjianPilihanGanda; // table nya siswa_jawab_ujian_pilgans
                $userJawab->id_soal                  = $soalId;
                $userJawab->id_jawaban_soal_ujian    = null;
                $userJawab->id_nilai_ujian_pilgan    = $nilaiUjianPilganSiswa->id_nilai_ujian_pilgan;
                $userJawab->save();
            }
            // dd($userJawab);
            DB::commit();

            return Redirect::action('Admin\SoalUjianController@show', array($nilaiUjianPilganSiswa->id_nilai_ujian_pilgan, $soalIds[0]))->with('messages',
                array(
                    array('success', 'Selamat Mengerjakan')
                ));

        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            return Redirect::action('Admin\UjianController@show', array($id_ujian))->with('messages',
                array(
                    array('error', $e->getMessage())
                ));

        }

    }

public function show($id_ujian)
  {
    try {

        $nilaiUjianPilganSiswa = NilaiUjianPilihanGandaSiswa::where('id_nilai_ujian_pilgan',$id_ujian)->first();
        // $nilaiUjianPilganSiswa = NilaiUjianPilihanGandaSiswa::find($id_ujian);
        // dd($nilaiUjianPilganSiswa);

        $id_user = Siswa::where('nisn_siswa', $nilaiUjianPilganSiswa->nisn_siswa)->first()->id_user; // persamaan dari : $nilaiUjianPilganSiswa->nisn_siswa->id_user

        if (!$nilaiUjianPilganSiswa){
                Session::flash('flash_message', 'Informasi pengambilan kuis tidak ditemukan');
                return Redirect::back();
            }

        if ($id_user != Auth::user()->id_user){
                Session::flash('flash_message', 'Admin dan Guru Berhak Melihat Detail dari Ujiannya Siswa');
            }

        // $ujian = Ujian::find($nilaiUjianPilganSiswa->id_ujian);
        // pake join lebih mantap
        $ujian = DB::table('ujians')
                 ->join('mata_pelajarans', 'ujians.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('ujians.*', 'mata_pelajarans.nama_mapel')
                 ->where('ujians.id_ujian', $nilaiUjianPilganSiswa->id_ujian)
                 ->first();
        // dd($ujian);

        if (!$ujian){
                Session::flash('flash_message', 'Detail Ujian dengan id ' . $nilaiUjianPilganSiswa->id_ujian . ' tidak ditemukan');
                return Redirect::back();
            }

        //tampilkan jawaban dan soals
          // userJawab nanti ganti jadi siswaJawab
          // $userJawab = SiswaJawabUjianPilihanGanda::whereRaw('id_nilai_ujian_pilgan = ?', array($nilaiUjianPilganSiswa->id_nilai_ujian_pilgan))->get();
        // pake join mantap
        $userJawab = DB::table('siswa_jawab_ujian_pilgans')
                 ->join('soals', 'siswa_jawab_ujian_pilgans.id_soal', '=', 'soals.id_soal')
                 ->select('siswa_jawab_ujian_pilgans.*', 'soals.pertanyaan', 'soals.id_ujian')
                 ->where('siswa_jawab_ujian_pilgans.id_nilai_ujian_pilgan', $nilaiUjianPilganSiswa->id_nilai_ujian_pilgan)
                 ->get();
        // dd($userJawab);
        $interval = '';
        if ($nilaiUjianPilganSiswa->wkt_selesai) {
            $start_date  = new \DateTime($nilaiUjianPilganSiswa->wkt_mulai);
            $since_start = $start_date->diff(new \DateTime($nilaiUjianPilganSiswa->wkt_selesai));
            $interval    = $since_start->h . ' jam ' . $since_start->i . ' menit ' . $since_start->s . ' detik';
        }

        //formatting
        foreach ($userJawab as $jawab) {
            $jawab->is_kosong = false;
            $jawab->is_benar  = false;
            $soals = Soal::where('id_ujian', $jawab->id_ujian)->get();
            $soals2 = DB::table('soals')
                 ->join('jawaban_soal_ujians', 'soals.id_soal', '=', 'jawaban_soal_ujians.id_soal')
                 ->select('soals.*', 'jawaban_soal_ujians.*')
                 ->where('soals.id_ujian', $nilaiUjianPilganSiswa->id_ujian)
                 ->first();

            if (!$jawab->id_jawaban_soal_ujian)
                $jawab->is_kosong = true;
            else {
                //get jawaban benar of soal
                $jawabanBenars = JawabanSoalUjian::where('id_soal', $jawab->id_soal)->get()->filter(function ($jawaban) {
                    if ($jawaban->is_benar) {
                        return $jawaban;
                    }
                });

                $isBenar = false;
                foreach ($jawabanBenars as $jawabanBenarFromSoal) {
                    if ($jawab->id_jawaban_soal_ujian == $jawabanBenarFromSoal->id_jawaban_soal_ujian) {
                        $isBenar = true;
                    }
                }

                if ($isBenar)
                    $jawab->is_benar = true;
            }
        }

        return view('admin.dashboard.ujian.show_hasil_ujian')
            ->with('ujian', $ujian)
            ->with('userjawabujian', $nilaiUjianPilganSiswa)
            ->with('userJawab', $userJawab)
            ->with('soals', $soals)
            // ->with('jawabans', $jawabans)
            ->with('interval', $interval);

    } catch (Exception $e) {
        return Redirect::action('Admin\UjianController@index_siswa')->with('messages',
            array(
                array('error', $e->getMessage())
            ));
       //  DashboardController@index atau siswa/ujian
    }
  }

public function destroy($id)
  {
      try {
          DB::beginTransaction();
          $nilaiUjianPilganSiswa = NilaiUjianPilihanGandaSiswa::find($id);

          if (!$nilaiUjianPilganSiswa)
              throw new Exception('Informasi pengambilan Ujian tidak ditemukan');

          //hapus user jawab
          $userJawab = SiswaJawabUjianPilihanGanda::whereRaw('id_siswa_jawab_ujian_pilgan = ? ', array($nilaiUjianPilganSiswa->id_siswa_jawab_ujian_pilgan))->get();
          foreach ($userJawab as $uj) {
              $uj->delete();
          }
          $nilaiUjianPilganSiswa->delete();

          DB::commit();
          Session::flash('flash_message', 'Pengambilan Ujian berhasil dihapus');
          if (Auth::user()->level == 11) {
            return redirect('admin/ujian/'.$nilaiUjianPilganSiswa->id_ujian.'/detail ');
          }else if (Auth::user()->level == 12) {
            return redirect('guru/ujian/'.$nilaiUjianPilganSiswa->id_ujian.'/detail ');
          }

      } catch (Exception $e) {
          DB::rollback();
          if ($nilaiUjianPilganSiswa)
              if (Auth::user()->level == 11) {
                  return redirect('admin/ujian/'.$nilaiUjianPilganSiswa->id_ujian.'/detail ');
                }else if (Auth::user()->level == 12) {
                  return redirect('guru/ujian/'.$nilaiUjianPilganSiswa->id_ujian.'/detail ');
                }
          else
              return Redirect::action('Admin\UjianController@index_siswa')->with('messages',
                  array(
                      array('error', $e->getMessage())
                  ));


      }
  }


} // end of code
