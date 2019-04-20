<!-- Terpaksa Ngoding di View -->
<?php   
  $siswa = \App\Siswa::where('id_user', Auth::user()->id_user)->first(); // detail  siswa yang sedang login.  
?>
@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Daftar Tugas Siswa
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          <?php if ( Auth::user()->level  == 11): ?>
            <li class="active">Admin</li>             
          <?php endif ?>

          <?php if (Auth::user()->level  == 12): ?>
            <li class="active">Guru</li> 
          <?php endif ?>  
           <li class="active">Daftar Tugas Siswa</li>
          </ol>
@stop
@section('content')          
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <strong>Daftar Tugas Siswa</strong>                 
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
                  <table id="dataTabelTugasSiswa" class="table table-bordered table-hover">
                    <thead>
                      <tr align="center">      
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Judul Tugas</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>                        
                        <th>Nama File</th>
                        <th>Keterangan File</th> 
                        <th>Nilai</th>           
                        <th>Lihat File</th>         
                        <th>Beri Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($SiswaJawabTugas as $tugasSiswa):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$tugasSiswa->kelas_tugas}}</td>
                        <td>{{$tugasSiswa->nama_mapel}}</td>
                        <td>{{$tugasSiswa->judul_tugas}}</td>
                        <td>{{$tugasSiswa->nisn_siswa}}</td> 
                        <td>{{$tugasSiswa->nama_siswa}}</td>
                        <td>{{$tugasSiswa->nama_file}}</td>
                        <td>{{$tugasSiswa->judul}}</td>
                        <td>{{$tugasSiswa->nilai}}</td> 
                        <td>
                          <?php if (Auth::user()->level == 11): ?>
                            <a href="{{{ URL::to('admin/tugas/'.$tugasSiswa->id_siswa_jawab_tugas.'/download_tugas_siswa') }}}">
                              <span class="label label-info"><i class="fa fa-print">&nbsp;&nbsp; Download &nbsp;&nbsp;</i></span>
                            </a>
                          <?php endif ?>
                        </td>                                               
                        <td>                         
                          <form id="formTugasNilaiSiswa" class="form-horizontal" role="form" method="POST" action="{{ url('admin/tugas/siswa/'.$tugasSiswa->id_siswa_jawab_tugas.'/update_nilai_tugas') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id_siswa_jawab_tugas" value="{{$tugasSiswa->id_siswa_jawab_tugas}}" >
                            <div class="col-md-3">
                              <input type="text" class="form-control" name="nilai" placeholder="Nilai" style="text-align: center; width: 60px; height: 30px;">
                              <small class="help-block"></small>                                                      
                            <button type="submit" class="btn btn-primary" id="button-reg" style="text-align: center; width: 70px; height: 35px;">
                              Simpan
                            </button>
                            </div> 
                          </form>
                        </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>      
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Judul Tugas</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>                        
                        <th>Nama File</th>
                        <th>Keterangan File</th> 
                        <th>Nilai</th>           
                        <th>Lihat File</th>         
                        <th>Beri Nilai</th>
                      </tr>
                    </tfoot>
                  </table>
                  <?php endif ?>                   
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
       

@endsection
@section('script')

<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
      $(function () {

        $('#dataTabelTugasSiswa').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

