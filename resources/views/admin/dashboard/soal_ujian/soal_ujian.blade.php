@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Data Soal Ujian
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
            <li class="active">Data Soal Ujian</li>
           
          </ol>
@stop
@section('content')
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">                  
                  <h3 class="box-title">Tambah Soal Ujian <a href="{{{ URL::to('admin/tambah_soal_ujian') }}}" class="btn btn-success btn-flat btn-sm" id="tambahSoalUjian" title="Tambah Soal Ujian"><i class="fa fa-plus"></i></a></h3>                  
                </div><!-- /.box-header -->
                
                <div class="box-body">                  

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#soals_pilihan_ganda" data-toggle="tab">Pilihan Ganda ( {{$countSoalPilgan}} )</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="soals_pilihan_ganda">
                        <br/>
                        <table id="dataTableSoalUjianPilihanGanda" class="table table-striped table-responsive">
                          <thead>
                            <tr>      
                              <th>No</th>  
                              <th>Pertanyaan</th>
                              <th>Jenis Soal</th>
                              <th>Nama Ujian</th>
                              <th>Poin</th>
                              <th>Gambar</th>
                              <th>Pembuat</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                           <?php $i=1; foreach ($soal_ujian as $dataSoalUjian):  ?>
                            <tr>
                              <td>{{$i}}</td>
                              <td data-toggle="popover" data-trigger="hover" data-content="{{$dataSoalUjian->pertanyaan}}" >{{str_limit(strip_tags($dataSoalUjian->pertanyaan), 30)}} </td>
                              <td>{{$dataSoalUjian->jenis_soal}}</td>
                              <td>{{$dataSoalUjian->judul_ujian}}</td>
                              <td>{{$poin}}</td>                              
                              <td>
                                  <?php if (!$dataSoalUjian->gambar == ""): ?>
                                    <img src="{{URL::to('upload_gambar/'.$dataSoalUjian->gambar) }}" alt="" style="width:100px"></td>                                    
                                  <?php endif ?>
                                  <?php if ($dataSoalUjian->gambar == ""): ?>
                                    Tidak ada Gambar
                                  <?php endif ?>
                                  
                              <td>{{$dataSoalUjian->pembuat_ujian}}</td>
                              <td>  
                                <div class="btn-group-vertical">
                                  <a href="{{{ URL::to('admin/soal_ujian/'.$dataSoalUjian->id_soal.'/edit') }}}" class="btn btn-warning btn-xs">
                                    <span class="glyphicon glyphicon-edit" ></span> Edit 
                                </a> 
                                <a href="{{{action('Admin\SoalUjianController@detail', [$dataSoalUjian->id_soal]) }}}" class="btn btn-primary btn-xs">
                                    <span class="glyphicon glyphicon-eye-open"></span> Lihat
                                </a>
                                <a href="{{{ action('Admin\SoalUjianController@hapus',[$dataSoalUjian->id_soal]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus data {{{($i).' - '.($dataSoalUjian->judul_ujian) }}}?')" class="btn btn-danger btn-xs">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </a>
                                </div>                                                                                                                       
                                </td>                              
                            </tr>
                            <?php $i++; endforeach  ?> 
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No</th>  
                              <th>Pertanyaan</th>
                              <th>Jenis Soal</th>
                              <th>Nama Ujian</th>
                              <th>Poin</th>
                              <th>Gambar</th>
                              <th>Pembuat</th>
                              <th>Aksi</th>
                            </tr>
                          </tfoot>
                        </table>

                    </div>                  
                </div>                  

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

        $('#dataTableSoalUjianPilihanGanda').DataTable({"pageLength": 10, "scrollX": true});
      });

    </script>

@endsection

