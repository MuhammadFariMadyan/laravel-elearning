@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Data Mata Pelajaran
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Admin</li>
            <li class="active">Data Mata Pelajaran</li>
           
          </ol>
@stop
@section('content')
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Mata Pelajaran <a href="{{{ URL::to('admin/tambahmapel') }}}" class="btn btn-success btn-flat btn-sm" id="tambahMataPelajaran" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <table id="dataTabelMataPelajaran" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>No</th>
                        <th>Nama Mata Pelajaran</th>  
                        <th>Nama Guru Pengajar</th>
                        <th>Aksi</th>                      
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($mata_pelajaran as $dataMataPelajaran):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataMataPelajaran->nama_mapel}}</td>
                        <td>{{$dataMataPelajaran->nama_guru}}</td>                                                                                                               
                        <td><a href="{{{ URL::to('admin/mapel/'.$dataMataPelajaran->id_mapel.'/edit') }}}">
                              <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                              </a> 
                          <a href="{{{ action('Admin\MataPelajaranController@hapus',[$dataMataPelajaran->id_mapel]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data Mata Pelajaran {{{($dataMataPelajaran->id_mapel).' - '.($dataMataPelajaran->nama_mapel) }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                              </a>                          
                          </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama Mata Pelajaran</th>  
                        <th>Nama Guru Pengajar</th>
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

        $('#dataTabelMataPelajaran').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

