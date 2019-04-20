@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Data Siswa
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Admin</li>
            <li class="active">Data Siswa</li>
           
          </ol>
@stop
@section('content')
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Siswa <a href="{{{ URL::to('admin/tambahsiswa') }}}" class="btn btn-success btn-flat btn-sm" id="tambahSiswa" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <table id="dataTabelSiswa" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>No</th>                                         
                        <th>NISN</th>                                               
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Email</th>
                        <th>No. Hp</th>
                        <th>TTL</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>                        
                        <th>Kelas</th>                        
                        <th>Status</th>
                        <th>ID User</th>                       
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($siswa as $dataSiswa):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataSiswa->nisn_siswa}}</td>
                        <td>{{$dataSiswa->nama_siswa}}</td>                        
                        <td><img src="{{URL::to('upload_gambar/'.$dataSiswa->foto_siswa) }}" alt="" style="width:100px"></td>
                        <td>{{$dataSiswa->email_siswa}}</td>
                        <td>{{$dataSiswa->no_hp_siswa}}</td>
                        <td>{{$dataSiswa->ttl_siswa}}</td>
                        <td>{{$dataSiswa->jns_kelamin_siswa}}</td>
                        <td>{{$dataSiswa->alamat_siswa}}</td>
                        <td>{{$dataSiswa->kelas_siswa}}</td>
                        <!-- <td>{{$dataSiswa->foto_siswa}}</td> -->
                        <td>{{$dataSiswa->status_siswa}}</td>
                        <td>{{$dataSiswa->id_user}}</td>
                                                                                                           
                        <td>
                          <a href="{{{ URL::to('admin/siswa/'.$dataSiswa->nisn_siswa.'/edit') }}}">
                              <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                          </a>
                          <a href="{{{ URL::to('admin/siswa/'.$dataSiswa->nisn_siswa.'/detail') }}}">
                              <span class="label label-info"><i class="fa fa-list"> Detail </i></span>
                        </a> 
                          <a href="{{{ action('Admin\SiswaController@hapus',[$dataSiswa->nisn_siswa]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data Siswa {{{($dataSiswa->nisn_siswa).' - '.($dataSiswa->nama_siswa) }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                          </a>                          
                        </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>                                         
                        <th>NISN</th>                                               
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Email</th>
                        <th>No. Hp</th>
                        <th>TTL</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>                        
                        <th>Kelas</th>                        
                        <th>Status</th>
                        <th>ID User</th>                       
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

        $('#dataTabelSiswa').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

