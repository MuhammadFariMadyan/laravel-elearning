@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Detail Soal {{ $jenis_ujian }}
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
            <li class="active">Detail Soal {{ $jenis_ujian }}</li>
          </ol>
@stop
@section('content')
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">                
                  <div class="pull-left">
                      <h3 class="box-title">{{ $judul_ujian }}</h3> 
                  </div>
                <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
                  <div class="pull-right"> 
                    <a href="{{{ URL::to('admin/tambah_soal_ujian') }}}" class="btn btn-success btn-xs">
                      <span class="fa fa-plus" ></span> Buat Soal
                    </a>  
                  </div> 
                <?php endif ?>                
                </div><!-- /.box-header -->                
                <?php foreach ($ujian as $itemUjian);  ?>                
                <div class="box-body">
                  <div class="row"> 
                    <br/> 
                   <div class="col-md-10" style="margin-left: 20%;">                                    
                    <div class="col-md-6">                      
                     <table border="0" width="85%">                   
                      <tbody>
                        <tr>
                          <td width="30%"><strong>Mata Pelajaran</strong></td>  
                          <td>: &nbsp;&nbsp; {{$itemUjian->nama_mapel}}</td>                          
                        </tr>                        
                        <tr>
                          <td><strong>Jumlah Soal</strong></td> 
                          <td>: &nbsp;&nbsp; {{$jumlah_soal}}</td>
                        </tr>                        
                        <tr>
                          <td><strong>Batas Waktu</strong></td>
                          <td>: &nbsp;&nbsp; {{$waktu_ujian}} Menit</td>
                        </tr>
                        <tr>
                          <td><strong>Kelas</strong></td> 
                          <td>: &nbsp;&nbsp; {{$kelas_ujian}}</td>                        
                        </tr>
                        <tr>
                          <td><strong>Acak Soal</strong></td> 
                          <td>: &nbsp;&nbsp; {{$is_random ? 'Ya' : 'Tidak'}}</td> 
                        </tr>                                                                        
                      </tbody>                      
                    </table>
                  </div>                  
                  <div class="col-md-3" align="left">
                    <table border="0" >                    
                      <tbody>
                        <tr>
                          <!-- <td width="40%"></td>   -->
                          <td><span class="glyphicon glyphicon-user" id="btnPopover1" title="Pembuat Ujian" data-toggle="tooltip"></span> {{$pembuat_ujian}}</td>                          
                        </tr>                        
                        <tr>
                          <td><span class="glyphicon glyphicon-plus" id="btnPopover2" title="Tanggal di buat" data-toggle="tooltip"></span> {{ date("d F Y H:i",strtotime($created_at)) }}</td>
                        </tr>                        
                        <tr>
                          <td><span class="glyphicon glyphicon-pencil" id="btnPopover3" title="Tanggal di update" data-toggle="tooltip"></span> {{ date("d F Y H:i",strtotime($updated_at)) }}</td>
                        </tr>
                        <tr>
                          <td><span class="glyphicon glyphicon-list-alt" id="btnPopover4" title="Jumlah Soal Ujian Pilihan Ganda saat ini" data-toggle="tooltip"></span> Jumlah Soal : {{$countSoalPilgan}}</td>
                        </tr>
                      </tbody>                      
                    </table>                      
                  </div>
                 </div>

                </div><!-- /.row -->
                <hr/>                
                <!-- Jawaban group-->
                  <blockquote style="font-size: 12pt">
                      <p>Informasi Ujian</p>
                      <p>1. Baca dengan seksama dan teliti ketika mengerjakan Ujian.</p>
                      <p>2. Pastikan koneksi anda bagus.</p>
                      <p>3. Pilih browser versi terbaru.</p>
                      <p>4. Jika mati lampu, segera hubungi guru mata pelajaran terkait untuk melakukan ujian ulang.</p>
                  </blockquote>

                <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs">
                      <li class="active"><a href="#soals" data-toggle="tab">Soal {{ $judul_ujian }}</a></li>                      
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="soals">
                      <br/>
                      <table id="dataTableSoalUjian" class="table table-bordered table-hover">
                          <thead>
                            <tr>      
                              <th>No</th>  
                              <th>Pertanyaan</th>
                              <th>Jenis Soal</th>
                              <th>Nama Ujian</th>
                              <th>Poin</th>
                              <!-- <th>Gambar</th> -->
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
                              <!-- <td><img src="{{URL::to('upload_gambar/'.$dataSoalUjian->gambar) }}" alt="" style="width:100px"></td>                         -->
                              <td>{{$dataSoalUjian->pembuat_ujian}}</td>
                              <td>  
                                <div class="btn-group-vertical">

                                  <?php if (Auth::user()->level  == 11): ?>
                                  <a href="{{{action('Admin\SoalUjianController@detail', [$dataSoalUjian->id_soal]) }}}" class="btn btn-primary btn-xs">
                                  <?php endif ?>
                                  <?php if (Auth::user()->level  == 12): ?>
                                  <a href="{{{action('Admin\SoalUjianController@detail_guru', [$dataSoalUjian->id_soal]) }}}" class="btn btn-primary btn-xs">
                                    <?php endif ?>
                                    <span class="glyphicon glyphicon-eye-open"></span> Lihat
                                  </a>

                                  <?php if (Auth::user()->level  == 11): ?>
                                  <a href="{{{ URL::to('admin/soal_ujian/'.$dataSoalUjian->id_soal.'/edit') }}}" class="btn btn-warning btn-xs">
                                  <?php endif ?>
                                  <?php if (Auth::user()->level  == 12): ?>
                                  <a href="{{{ URL::to('guru/soal_ujian/'.$dataSoalUjian->id_soal.'/edit') }}}" class="btn btn-warning btn-xs">
                                  <?php endif ?>
                                    <span class="glyphicon glyphicon-edit" ></span> Edit 
                                  </a> 

                                  <?php if (Auth::user()->level  == 11): ?>
                                  <a href="{{{ action('Admin\SoalUjianController@hapus',[$dataSoalUjian->id_soal]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus data {{{($i).' - '.($dataSoalUjian->judul_ujian) }}}?')" class="btn btn-danger btn-xs">
                                  <?php endif ?>
                                  <?php if (Auth::user()->level  == 12): ?>
                                  <a href="{{{ action('Admin\SoalUjianController@hapus_guru',[$dataSoalUjian->id_soal]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus data {{{($i).' - '.($dataSoalUjian->judul_ujian) }}}?')" class="btn btn-danger btn-xs">
                                  <?php endif ?>
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
                              <!-- <th>Gambar</th> -->
                              <th>Pembuat</th>
                              <th>Aksi</th>
                            </tr>
                          </tfoot>
                        </table>                      
                    </div>
                  </div>
                <?php endif ?>              
                <hr>              
              
              <?php if (Auth::user()->level  == 11): ?>
                <div class="pull-right clearfix">
                  <a href="{{{ URL::to('admin/siswa_ujian/'.$id_ujian) }}}" class="btn btn-success">
                      <span class="glyphicon glyphicon-align-left"></span> Lihat Ranking
                  </a>
                </div>  
              <?php endif ?>

              <?php if (Auth::user()->level  == 12): ?>
                <div class="pull-right clearfix">
                  <a href="{{{ URL::to('guru/siswa_ujian/'.$id_ujian) }}}" class="btn btn-success">
                      <span class="glyphicon glyphicon-align-left"></span> Lihat Ranking
                  </a>
                </div>                            
              <?php endif ?>
                
                <form id="formSiswaUjian" class="form-horizontal" role="form" method="POST" action="{{ url('siswa/ujian') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_ujian" value="{{$id_ujian}}" >                
              <?php if (Auth::user()->level  == 13): ?>  
                <div class="pull-right clearfix">
                  <a href="{{{ URL::to('siswa/siswa_ujian/'.$id_ujian) }}}" class="btn btn-success">
                      <span class="glyphicon glyphicon-align-left"></span> Lihat Ranking
                  </a>
                </div>
                <div class="clearfix">
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-play"></span> Mulai mengerjakan
                        Ujian
                    </button>
                </div>
              <?php endif ?>
                </form>

                </div><!-- /.box-body -->
                 
              </div>
            </div>                       
          </div><!-- /.row -->
@endsection
@section('script')

<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
      $(function () {

        $('#dataTableSoalUjian').DataTable({"pageLength": 10, "scrollX": true});
      });

</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#btnPopover1').tooltip();
    $('#btnPopover2').tooltip();
    $('#btnPopover3').tooltip();
    $('#btnPopover4').tooltip();
  });
</script>

@endsection

