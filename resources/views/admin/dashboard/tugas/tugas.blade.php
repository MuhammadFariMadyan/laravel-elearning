<!-- Terpaksa Ngoding di View -->
<?php   
  $siswa = \App\Siswa::where('id_user', Auth::user()->id_user)->first(); // detail  siswa yang sedang login.  
?>
@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Data Tugas
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

          <?php if (Auth::user()->level  == 13): ?>
            <li class="active">Siswa</li>             
          <?php endif ?>
            <li class="active">Data Tugas</li>           
          </ol>
@stop
@section('content')          
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
                    <h3 class="box-title">Tambah Tugas <a href="{{{ URL::to('admin/tambahtugas') }}}" class="btn btn-success btn-flat btn-sm" id="tambahTugas" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                    <h3 class="box-title">SMS Gateway <a href="{{{ URL::to('admin/message/send') }}}" class="btn btn-success btn-flat btn-sm" id="tambahSMSGateway" title="SMS Pemberitahuan Tugas ke seluruh Siswa"><i class="fa fa-envelope"></i></a></h3>
                  <?php endif ?>
                  <?php if ( Auth::user()->level  == 13): ?>                    
                    <h3 class="box-title"><strong> Daftar Tugas </strong></h3>
                  <?php endif ?>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
                  <table id="dataTabelTugas" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th style="width: 3%;">No</th>                                         
                        <th>Judul</th>                                               
                        <th>Deskripsi</th>
                        <th>Kelas</th>
                        <th>Waktu</th>
                        <th>Pembuat</th>
                        <th>Tanggal</th>
                        <th style="width: 15%;">Info</th>                        
                        <th>Status</th>
                        <th>Status SMS</th>
                        <th>Mata Pelajaran</th>                                              
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($tugas as $dataTugas):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataTugas->judul_tugas}}</td>
                        <td>{{$dataTugas->deskripsi_tugas}}</td>
                        <td>{{$dataTugas->kelas_tugas}}</td>
                        <td>{{$dataTugas->waktu_tugas}}</td>
                        <td>{{$dataTugas->pembuat_tugas}}</td>
                        <td>{{$dataTugas->tgl_tugas}}</td>
                        <td>{{$dataTugas->info_tugas}}</td>
                        <td>{{$dataTugas->status_tugas}}</td>
                        <td>{{$dataTugas->sms_status_tugas}}</td>
                        <td>{{$dataTugas->nama_mapel}}</td>                        
                                                                                                           
                        <td>
                          
                            <a href="{{{ URL::to('admin/message/send/'.$dataTugas->id_tugas.'/edit') }}}">
                          
                              <span class="label label-primary" ><i class="fa fa-envelope" >&nbsp;&nbsp; Kirim Pesan &nbsp;&nbsp;</i></span>
                          </a>
                          <a href="{{{ URL::to('admin/tugas/'.$dataTugas->id_tugas.'/peserta_koreksi') }}}">
                              <span class="label label-info" ><i class="fa fa-edit" >&nbsp;&nbsp; Peserta & Koreksi &nbsp;&nbsp;</i></span>
                          </a>
                          <a href="{{{ URL::to('admin/tugas/'.$dataTugas->id_tugas.'/edit') }}}">
                              <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                          </a> 
                          <a href="{{{ action('Admin\TugasController@hapus',[$dataTugas->id_tugas]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data Tugas {{{($i).' - '.($dataTugas->judul_tugas) }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                          </a>
                        </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>                                         
                        <th>Judul</th>                                               
                        <th>Deskripsi</th>
                        <th>Kelas</th>
                        <th>Waktu</th>
                        <th>Pembuat</th>
                        <th>Tanggal</th>
                        <th>Info</th>                        
                        <th>Status</th>
                        <th>Status SMS</th>
                        <th>Mata Pelajaran</th>                       
                        <th>Aksi</th>                        
                      </tr>
                    </tfoot>
                  </table>
                  <?php endif ?> 
                  <?php if ( Auth::user()->level  == 13): ?>
                    <table id="dataTabelTugasSiswa" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th style="width: 2%;">No</th>
                        <th style="width: 6%;">Mata Pelajaran</th> 
                        <th style="width: 5%;">Kelas</th>                                          
                        <th style="width: 15%;">Judul</th>                                               
                        <th style="width: 25%;">Deskripsi</th>                        
                        <th style="width: 5%;">Waktu</th>
                        <th style="width: 5%;">Pembuat</th>
                        <th style="width: 5%;">Tanggal</th>
                        <th style="width: 25%;">Info</th>                                                                                                                  
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($tugas as $dataTugas):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataTugas->nama_mapel}}</td>
                        <td>{{$dataTugas->kelas_tugas}}</td>
                        <td>{{$dataTugas->judul_tugas}}</td>
                        <td>{{$dataTugas->deskripsi_tugas}}</td>
                        <td>{{$dataTugas->waktu_tugas}}</td>
                        <td>{{$dataTugas->pembuat_tugas}}</td>
                        <td>{{date("d F Y",strtotime($dataTugas->tgl_tugas))}}</td>
                        <td>{{$dataTugas->info_tugas}}</td>
                        <td> 
                          <?php if ($siswa->kelas_siswa == $dataTugas->kelas_tugas): ?>                            
                            <a href="{{{ URL::to('siswa/tugas/'.$dataTugas->id_tugas.'/detail_tugas_siswa') }}}"
                               class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-edit"></span> Kerjakan
                            </a> 
                          <?php endif ?>                                                   
                        </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th> 
                        <th>Kelas</th>                                          
                        <th>Judul</th>                                               
                        <th>Deskripsi</th>                        
                        <th>Waktu</th>
                        <th>Pembuat</th>
                        <th>Tanggal</th>
                        <th>Info</th>                                                                                                                  
                        <th>Aksi</th>                       
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

        $('#dataTabelTugas').DataTable({"pageLength": 10, "scrollX": true});
        $('#dataTabelTugasSiswa').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

