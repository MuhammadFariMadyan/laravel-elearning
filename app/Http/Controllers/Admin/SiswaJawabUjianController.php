<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SiswaJawabUjianPilihanGanda as SiswaJawabUjianPilihanGanda;
use App\NilaiUjianPilihanGandaSiswa as NilaiUjianPilihanGandaSiswa;

class SiswaJawabUjianController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $nilaiUjianPilganSiswa = NilaiUjianPilihanGandaSiswa::whereRaw('id_ujian = ? and wkt_selesai is not null', array($id))
                ->orderBy('nilai', 'desc')
                ->orderBy('int_time', 'asc')->get(
                    array(DB::raw("TIMEDIFF(wkt_selesai, wkt_mulai) as 'int_time'"),
                        DB::raw('nilai_ujian_pilgan_siswas.*')
                    ));

            // $ujian = Ujian::find($id_ujian);
            $ujian = DB::table('ujians')                  
                 ->join('mata_pelajarans', 'ujians.id_mapel', '=', 'mata_pelajarans.id_mapel')
                 ->select('ujians.*', 'mata_pelajarans.nama_mapel')
                 ->where('ujians.id_ujian', $id)
                 ->first();

            if (!$ujian)
                throw new Exception('Detail Ujian dengan kode ' . $id_ujian . ' tidak ditemukan');

            if (!$nilaiUjianPilganSiswa->isEmpty()) {
                foreach ($nilaiUjianPilganSiswa as $ujb) {
                    $start_date    = new \DateTime($ujb->wkt_mulai);
                    $since_start   = $start_date->diff(new \DateTime($ujb->wkt_selesai));
                    $ujb->interval = $since_start->h . ' jam ' . $since_start->i . ' menit ' . $since_start->s . ' detik';
                }
            }else {
                if (Auth::user()->level == 11 or Auth::user()->level == 12) {
                    Session::flash('flash_message', 'Belum ada siswa yang mengambil ujian ini');
                    return Redirect::back(); 
                }
                Session::flash('flash_message', 'Anda belum pernah mengambil ujian ini, Silahkan Klik Tombol "Mulai mengerjakan Ujian" untuk mengambil ujian ini');
                return Redirect::back(); 
            }

            return view('admin.dashboard.siswa_jawab_ujian.show_peringkat_siswa')
                ->with('userJawabLembars', $nilaiUjianPilganSiswa)
                ->with('ujian', $ujian);

        } catch (Exception $e) {
            Log::error($e);
            return Redirect::action('Admin\UjianController@index_siswa')->with('messages',
                array(
                    array('error', $e->getMessage())
                ));

        }
    }    
}
