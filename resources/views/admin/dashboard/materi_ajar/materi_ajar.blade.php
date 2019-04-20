@extends('admin.layout.master')
@section('breadcrump')          
        <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
        <h1>Data Materi Ajar <small>Control panel</small> </h1>          
        <?php endif ?>   
        <?php if (Auth::user()->level  == 13): ?>
          <h1>Data Materi Mata Pelajaran <small>Control panel</small> </h1> 
        <?php endif ?>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>                        
          <?php if ( Auth::user()->level  == 11): ?>
            <li class="active">Admin</li> 
            <li class="active">Data Materi Ajar</li>        
          <?php endif ?>

          <?php if (Auth::user()->level  == 12): ?>
            <li class="active">Guru</li> 
            <li class="active">Data Materi Ajar</li>
          <?php endif ?>  

          <?php if (Auth::user()->level  == 13): ?>
            <li class="active">Siswa</li> 
            <li class="active">Data Materi Mata Pelajaran</li>
          <?php endif ?>
          </ol>
@stop
@section('content')                  
          <div class="row">                
            <div class="col-xs-12">
              <div class="box box-danger"><div class="box-header with-border">                
              <?php if ( Auth::user()->level  == 11): ?>                
                <h3 class="box-title">Tambah Materi Ajar <a href="{{{ URL::to('admin/tambahmateri_ajar') }}}" class="btn btn-success btn-flat btn-sm" id="tambahMateriAjar" title="Tambah"><i class="fa fa-plus"></i></a></h3>                
              <?php endif ?>   
              <?php if ( Auth::user()->level  == 12): ?>                
                <h3 class="box-title">Tambah Materi Ajar <a href="{{{ URL::to('guru/tambahmateri_ajar') }}}" class="btn btn-success btn-flat btn-sm" id="tambahMateriAjar" title="Tambah"><i class="fa fa-plus"></i></a></h3>                
              <?php endif ?>   
              <?php if (Auth::user()->level  == 13): ?>                
                 <h3 class="box-title"><strong> Daftar Materi Mata Pelajaran </strong></h3>
              <?php endif ?>               
               </div><!-- /.box-header -->  
                <div class="box-body">
                  <table id="dataTabelMateriAjar" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>No</th>  
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>                                       
                        <th>Judul Materi</th>                                               
                        <th>Nama File Materi</th>                                       
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($materi_ajar as $dataMateriAjar):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataMateriAjar->nama_mapel}}</td>
                        <td>{{$dataMateriAjar->materi_kelas}}</td>
                        <td>{{$dataMateriAjar->materi_judul}}</td>
                        <td>{{$dataMateriAjar->materi_nama}}</td>
                        <td>
                          <?php if (Auth::user()->level  == 13): ?>                          
                          <a href="{{{ URL::to('siswa/materi_ajar/'.$dataMateriAjar->id_materi_ajar.'/download') }}}"
                               class="btn btn-primary btn-xs">
                                <span class="fa fa-print"></span> Download
                          </a>
                          <?php endif ?>
                          <?php if ( Auth::user()->level  == 11 ): ?>
                            <a href="{{{ URL::to('admin/materi_ajar/'.$dataMateriAjar->id_materi_ajar.'/download') }}}">
                                <span class="label label-info"><i class="fa fa-print">&nbsp;&nbsp; Download &nbsp;&nbsp;</i></span>                             
                            </a>
                            <a href="{{{ URL::to('admin/materi_ajar/'.$dataMateriAjar->id_materi_ajar.'/edit') }}}">
                                <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                            </a>                           
                            <a href="{{{ action('Admin\MateriAjarController@hapus',[$dataMateriAjar->id_materi_ajar]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data MateriAjar {{{($dataMateriAjar->materi_judul).' - '.($dataMateriAjar->materi_nama) }}}?')">
                                <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                            </a> 
                          <?php endif ?>

                          <?php if ( Auth::user()->level  == 12 ): ?>
                            <a href="{{{ URL::to('guru/materi_ajar/'.$dataMateriAjar->id_materi_ajar.'/download') }}}">
                                <span class="label label-info"><i class="fa fa-print">&nbsp;&nbsp; Download &nbsp;&nbsp;</i></span>                             
                            </a>
                            <a href="{{{ URL::to('guru/materi_ajar/'.$dataMateriAjar->id_materi_ajar.'/edit') }}}">
                                <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                            </a>                           
                            <a href="{{{ action('Admin\MateriAjarController@hapus_guru',[$dataMateriAjar->id_materi_ajar]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data MateriAjar {{{($dataMateriAjar->materi_judul).' - '.($dataMateriAjar->materi_nama) }}}?')">
                                <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
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
                        <th>Judul Materi</th>                                               
                        <th>Nama File Materi</th>                                       
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
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

        $('#dataTabelMateriAjar').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

