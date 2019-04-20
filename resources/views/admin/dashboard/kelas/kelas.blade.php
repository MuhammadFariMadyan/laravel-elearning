@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Data Kelas
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
            <li class="active">Data Kelas</li>
          </ol>
@stop
@section('content') 
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                <?php if ( Auth::user()->level  == 11): ?>
                  <h3 class="box-title">Tambah Kelas <a href="{{{ URL::to('admin/tambahkelas') }}}" class="btn btn-success btn-flat btn-sm" id="tambahPengumuman" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                <?php endif ?>
                <?php if (Auth::user()->level  == 12): ?>
                  <strong>Daftar Kelas yang anda ampu</strong>
                <?php endif ?> 
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <table id="dataTabelKelas" class="table table-bordered table-hover" >
                    <thead>
                      <tr> 
                        <th>No</th> 
                        <th>Kelas</th>                                        
                        <th >Mata Pelajaran</th>  
                        <?php if ( Auth::user()->level  == 11): ?>                    
                        <th style="text-align: center;">Aksi</th>
                        <?php endif ?>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($kelas as $dataKelas):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataKelas->nama_kelas}}</td>
                        <td>{{$dataKelas->nama_mapel}}</td>
                          <?php if ( Auth::user()->level  == 11): ?>
                          <td style="text-align: center;"> 
                          <a href="{{{ URL::to('admin/kelas/'.$dataKelas->id.'/edit') }}}">
                              <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                              </a>                               
                          <a href="{{{ action('Admin\KelasController@hapus',[$dataKelas->id]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data Kelas {{{($dataKelas->nama_kelas).' - '.($dataKelas->nama_mapel) }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                          </a>
                          </td>
                          <?php endif ?>                        
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>                    
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

        $('#dataTabelKelas').DataTable({"pageLength": 10, }); //"scrollX": true

      });

    </script>

@endsection

