@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Data Guru
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Admin</li>
            <li class="active">Data Guru</li>
           
          </ol>
@stop
@section('content')          
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Guru <a href="{{{ URL::to('admin/tambahguru') }}}" class="btn btn-success btn-flat btn-sm" id="tambahGuru" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <table id="dataTabelGuru" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>No</th>                                         
                        <th>NIP</th>                                               
                        <th>Nama</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama </th>
                        <th>No. Hp</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Jabatan </th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>ID User</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($guru as $dataGuru):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataGuru->nip_guru}}</td>
                        <td>{{$dataGuru->nama_guru}}</td>
                        <td>{{$dataGuru->ttl_guru}}</td>
                        <td>{{$dataGuru->jns_kelamin_guru}}</td>
                        <td>{{$dataGuru->agama_guru}}</td>
                        <td>{{$dataGuru->no_telp_guru}}</td>
                        <td>{{$dataGuru->email_guru}}</td>
                        <td>{{$dataGuru->alamat_guru}}</td>
                        <td>{{$dataGuru->jabatan_guru}}</td>                        
                        <td><img src="{{URL::to('upload_gambar/'.$dataGuru->foto_guru) }}" alt="" style="width:100px"></td>
                        <td>{{$dataGuru->status_guru}}</td>                                                                    
                        <td>{{$dataGuru->id_user}}</td>                                           
                        <td>
                          <a href="{{{ URL::to('admin/guru/'.$dataGuru->nip_guru.'/edit') }}}">
                              <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                          </a> 
                          <a href="{{{ URL::to('admin/guru/'.$dataGuru->nip_guru.'/detail') }}}">
                              <span class="label label-info"><i class="fa fa-list"> Detail </i></span>
                          </a>
                          <a href="{{{ action('Admin\GuruController@hapus',[$dataGuru->nip_guru]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data Guru {{{($dataGuru->nip_guru).' - '.($dataGuru->nama_guru) }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                          </a>                          
                          </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>                                         
                        <th>NIP</th>                                               
                        <th>Nama</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama </th>
                        <th>No. Hp</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Jabatan </th>
                        <th>Foto</th>
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

        $('#dataTabelGuru').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

