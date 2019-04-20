@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Data Pengumuman
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
            <li class="active">Data Pengumuman</li>
           
          </ol>
@stop
@section('content') 
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
                  <h3 class="box-title">Tambah Pengumuman <a href="{{{ URL::to('admin/tambahpengumuman') }}}" class="btn btn-success btn-flat btn-sm" id="tambahPengumuman" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                <?php endif ?>
                <?php if ( Auth::user()->level  == 13): ?>
                    <h3 class="box-title"><strong> Daftar Pengumuman </strong></h3>
                <?php endif ?>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <table id="dataTabelPengumuman" class="table table-bordered table-hover" >
                    <thead>
                      <tr> 
                        <th width="3%">No</th> 
                        <th>Tanggal</th>                                        
                        <th width="15%">Judul</th>                                               
                        <th width="60%">Deskripsi</th>
                        <th>Author</th>                         
                      <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
                        <th style="text-align: center;">Aksi</th>
                      <?php endif ?>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($pengumuman as $dataPengumuman):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{ date("d F Y",strtotime($dataPengumuman->updated_at))}}</td>
                        <td>{{$dataPengumuman->judul}}</td>
                        <td>{{$dataPengumuman->deskripsi}}</td>
                        <td>{{$dataPengumuman->author}}</td>                        
                      <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>                        
                        <td style="text-align: center;">                          
                            <a href="{{{ URL::to('admin/pengumuman/'.$dataPengumuman->id_pengumuman.'/edit') }}}">
                                <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                            </a> 
                            <a href="{{{ action('Admin\PengumumanController@hapus',[$dataPengumuman->id_pengumuman]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Judul Pengumuman {{{($dataPengumuman->judul).' - nomor '.$i }}}?')">
                                <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                            </a>                         
                        <!-- <?php if ( Auth::user()->level  == 13): ?>
                            <a href="{{{ URL::to('admin/pengumuman/'.$dataPengumuman->id_pengumuman.'/edit') }}}">
                                <span class="label label-warning" ><i class="fa fa-eye" >&nbsp;&nbsp; Lihat &nbsp;&nbsp;</i></span>
                            </a>                            
                        <?php endif ?> -->
                        </td> 
                      <?php endif ?>
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>  
                        <th>Tanggal</th>                                       
                        <th>Judul</th>                                               
                        <th>Deskripsi</th>
                        <th>Author</th>                         
                      <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
                        <th style="text-align: center;">Aksi</th>
                      <?php endif ?>
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

        $('#dataTabelPengumuman').DataTable({"pageLength": 5, }); //"scrollX": true

      });

    </script>

@endsection

