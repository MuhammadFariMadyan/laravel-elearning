@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Admin</li>
           
          </ol>
@stop
@section('content')
          <h3> Data Nilai Ujian</h3>
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Nilai Ujian <a href="{{{ URL::to('admin/tambahnilai_ujian') }}}" class="btn btn-success btn-flat btn-sm" id="tambahNilaiUjian" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <table id="dataTableNilaiUjian" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>No</th>                                         
                        <th>NISN</th>                                               
                        <th>Nama Siswa</th>
                        <th>Mata Pelajaran</th> 
                        <th>Judul Ujian</th>
                        <th>Nilai Ujian</th>                        
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($nilai_ujian as $dataNilai):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataNilai->nisn_siswa}}</td>
                        <td>{{$dataNilai->nama_siswa}}</td>
                        <td>{{$dataNilai->nama_mapel}}</td>
                        <td>{{$dataNilai->judul_ujian}}</td>
                        <td>{{$dataNilai->nilai_ujian}}</td>                        

                        <td><a href="{{{ URL::to('admin/nilai_ujian/'.$dataNilai->id_nilai_ujian_siswa.'/edit') }}}">
                              <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;</i></span>
                              </a> 
                          <a href="{{{ action('Admin\NilaiUjianController@hapus',[$dataNilai->id_nilai_ujian_siswa]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data Nilai Ujian  {{{($dataNilai->nisn_siswa).' - '.($dataNilai->nama_siswa) }}}?')">
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
                        <th>Nama Siswa</th>
                        <th>Mata Pelajaran</th> 
                        <th>Judul Ujian</th>
                        <th>Nilai Ujian</th>
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

        $('#dataTableNilaiUjian').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

