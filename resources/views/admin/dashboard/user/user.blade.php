@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Data Pengguna
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Admin</li>
            <li class="active">Data Pengguna</li>
           
          </ol>
@stop
@section('content')
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah User <a href="{{{ URL::to('admin/tambahuser') }}}" class="btn btn-success btn-flat btn-sm" id="tambahUser" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <table id="dataTabelUser" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>No</th>                                         
                        <th>Nama</th>
                        <th>Username</th>                        
                        <th>Email</th>   
                        <th>Jenis Hak Akses</th>                                          
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($user as $dataUser):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataUser->name}}</td>
                        <td>{{$dataUser->username}}</td>
                        <td>{{$dataUser->email}}</td>
                        <td>
                          @if($dataUser->level==11)
                            Admin
                          @elseif($dataUser->level==12)
                            Guru
                          @elseif($dataUser->level==13)
                            Siswa
                          @endif                          
                        </td>                        
                        <td>
                          <a href="{{{ URL::to('admin/user/'.$dataUser->id_user.'/edit') }}}" >
                              <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                          </a>  
                          <a href="{{{ URL::to('admin/user/'.$dataUser->id_user.'/ubahpassword') }}}">
                              <span class="label label-success" ><i class="fa fa-gear" >&nbsp;&nbsp; ubah password &nbsp;&nbsp;</i></span>
                          </a>                        
                          <a href="{{{ action('AdminController@hapus',[$dataUser->id_user]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data Siswa {{{($dataUser->id_user).' - '.($dataUser->name) }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                          </a>                          
                        </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>                                         
                        <th>Nama</th>
                        <th>Username</th>                        
                        <th>Email</th>   
                        <th>Jenis Hak Akses</th>                                          
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

        $('#dataTabelUser').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

