@extends('admin.layout.master')
@section('breadcrump')
          <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
            <h1> Data Ujian
          <?php endif ?>
          <?php if ( Auth::user()->level  == 13): ?>
            <h1>Ujian Online kelas "{{ $siswa->kelas_siswa }}"
          <?php endif ?>
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>            
          <?php if ( Auth::user()->level  == 11): ?>
            <li class="active">Admin</li> 
            <li class="active">Data Ujian</li>        
          <?php endif ?>

          <?php if (Auth::user()->level  == 12): ?>
            <li class="active">Guru</li> 
            <li class="active">Data Ujian</li> 
          <?php endif ?>  

          <?php if (Auth::user()->level  == 13): ?>
            <li class="active">Siswa</li> 
            <li class="active">Ujian Online kelas "{{ $siswa->kelas_siswa }}"</li> 
          <?php endif ?>           
          </ol>
@stop

@section('content')

          <div class="row">
            <div class="col-xs-12">
              <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
              <div class="box box-danger">                
                  <div class="box-header with-border">
                    
                    <?php if ( Auth::user()->level  == 11): ?>
                      <h3 class="box-title">Tambah Ujian <a href="{{{ URL::to('admin/tambahujian') }}}" class="btn btn-success btn-flat btn-sm" id="tambahUjian" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                    <?php endif ?>
                    <?php if (Auth::user()->level  == 12): ?>
                      <h3 class="box-title">Tambah Ujian <a href="{{{ URL::to('guru/tambahujian') }}}" class="btn btn-success btn-flat btn-sm" id="tambahUjian" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                    <?php endif ?>
                  </div><!-- /.box-header -->                  

                <div class="box-body">
                  <table id="dataTabelUjian" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>No</th>  
                        <th>Jenis </th>                          
                        <th>Nama</th>  
                        <th>Keterangan</th>
                        <th>Mata Pelajaran</th>          
                        <th>Kelas</th>
                        <th>Waktu</th>
                        <th>Jumlah Soal</th>
                        <th>Acak Soal</th>                       
                        <th>Tanggal</th>                    
                        <th>Status Ujian</th>   
                        <th>Pembuat</th> 
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($ujian as $dataUjian):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataUjian->jenis_ujian}}</td>
                        <td>{{$dataUjian->judul_ujian}}</td>
                        <td>{{$dataUjian->info_ujian}}</td>
                        <td>{{$dataUjian->nama_mapel}}</td> 
                        <td>{{$dataUjian->kelas_ujian}}</td>
                        <td>{{$dataUjian->waktu_ujian}} Menit</td>
                        <td>{{$dataUjian->jumlah_soal}}</td> 
                        <td>{{$dataUjian->is_random ? 'Ya' : 'Tidak'}}</td>
                        <td>{{$dataUjian->tgl_ujian}}</td>
                        <td>{{$dataUjian->status_ujian}}</td>
                        <td>{{$dataUjian->pembuat_ujian}}</td>
                        <td>                            
                          <?php if (Auth::user()->level  == 11): ?>                            
                            <a href="{{{ URL::to('admin/ujian/'.$dataUjian->id_ujian.'/detail') }}}" class="btn btn-primary btn-xs">
                              <span class="glyphicon glyphicon-eye-open"></span> Lihat
                            </a>
                          <?php endif ?>
                          <?php if (Auth::user()->level  == 12): ?>
                            <a href="{{{ URL::to('guru/ujian/'.$dataUjian->id_ujian.'/detail') }}}" class="btn btn-primary btn-xs">
                              <span class="glyphicon glyphicon-eye-open"></span> Lihat
                            </a>
                          <?php endif ?>                            
                            <a href="{{{ URL::to('admin/ujian/'.$dataUjian->id_ujian.'/edit') }}}" class="btn btn-warning btn-xs">
                              <span class="glyphicon glyphicon-edit" ></span> Edit 
                            </a>
                            <a href="{{{ action('Admin\UjianController@hapus',[$dataUjian->id_ujian]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Data Ujian {{{($i).' - '.($dataUjian->judul_ujian) }}}?')" class="btn btn-danger btn-xs">
                              <span class="glyphicon glyphicon-trash"></span> Delete
                            </a> 
                                                        
                        </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>  
                        <th>Jenis </th>                          
                        <th>Nama</th>  
                        <th>Keterangan</th>
                        <th>Mata Pelajaran</th>          
                        <th>Kelas</th>
                        <th>Waktu</th>
                        <th>Jumlah Soal</th>
                        <th>Acak Soal</th>                       
                        <th>Tanggal</th>                    
                        <th>Status Ujian</th>   
                        <th>Pembuat</th> 
                        <th>Aksi</th>                        
                      </tr>
                    </tfoot>
                  </table>        
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            <?php endif ?>

            <?php if (Auth::user()->level  == 13): ?> 
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title"><strong> Daftar ujian</strong></h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body" style="display: block;">

                <table id="dataTabelUjianSiswa" class="table table-striped table-responsive">
                  <thead>
                    <th>No</th>
                    <th>Mata Pelajaran</th> 
                    <th>Judul</th>
                    <th>Kelas</th>
                    <th>Acak Soal</th>
                    <th>Jumlah Soal</th>
                    <th>Tanggal Ujian</th>
                    <th>Ambil</th>
                  </thead>
                  <tbody>
                  <?php $i=1; foreach ($ujianSiswa as $dataUjian):  ?>                  
                  <tr>
                    <td>{{$i}}</td> 
                    <td>{{$dataUjian->nama_mapel}}</td> 
                    <td>{{$dataUjian->judul_ujian}}</td>
                    <td>{{$dataUjian->kelas_ujian}}</td>
                    <td>{{$dataUjian->is_random ? 'Ya' : 'Tidak'}}</td>
                    <td>{{$dataUjian->jumlah_soal}}</td>
                    <td>{{date("d F Y",strtotime($dataUjian->tgl_ujian))}}</td>                    
                    <td>
                      <a href="{{{action('Admin\UjianController@detail', [$dataUjian->id_ujian]) }}}"
                         class="btn btn-info btn-xs">
                          <span class="glyphicon glyphicon-play"></span> Ambil
                      </a>
                    </td>
                  </tr>
                  <?php $i++; endforeach  ?> 
                  </tbody>
                </table> 

              </div><!-- /.box-body -->                                      
            </div>

            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title"><strong> Daftar Pengambilan Ujian</strong></h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
            <div class="box-body" style="display: block;">
            @if ($userJawabLembars->isEmpty())
            <div class="">
                @if(!is_array($userJawabLembars))
                <div class="alert alert-warning" align="center"><font color="black"><strong>Anda</strong> Belum Mengikuti Ujian </font></div>
                @endif
            </div>
            @endif
            
            @if (!$userJawabLembars->isEmpty())
            <table id="dataTabelPengambilanUjianSiswa" class="table table-striped table-responsive">
                <thead>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Jenis Ujian</th>
                <th>Judul</th>
                <th>Waktu Pengambilan</th>
                <th>Nilai Akhir</th>
                <th style="width: 15%;">Aksi</th>
                </thead>
                <tbody>
                <?php $i=1; foreach ($userJawabLembars as $userJawabLembar):  ?> 
                <tr>
                    <td>
                        {{$i}}
                    </td>
                    <td>
                      <?php 
                        $ujian = DB::table('ujians')                  
                           ->join('mata_pelajarans', 'ujians.id_mapel', '=', 'mata_pelajarans.id_mapel')
                           ->select('ujians.*', 'mata_pelajarans.nama_mapel')
                           ->where('id_ujian', $userJawabLembar->id_ujian)
                           ->first(); 
                       ?>
                        {{$ujian->nama_mapel}} 
                    </td>
                    <td>
                        {{$ujian->jenis_ujian}} 
                    </td>
                    <td>
                        {{$ujian->judul_ujian}} 
                    </td>
                    <td> 
                        {{ date("d F Y H:i:s",strtotime($userJawabLembar->wkt_mulai)) }} 
                    </td>
                    <td> 
                        {{$userJawabLembar->wkt_selesai ? $userJawabLembar->nilai : 'Belum Selesai'}}
                    </td>
                    <td>
                        @if ($userJawabLembar->wkt_selesai)   
                        <div class="btn-group-horizontal">                                            
                        <a href="{{{ URL::to('siswa/ujian/'.$userJawabLembar->id_nilai_ujian_pilgan) }}}"
                           class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-eye-open"></span> Lihat
                        </a>                                             
                        <a href="{{action('Admin\SiswaJawabUjianController@show', array($userJawabLembar->id_ujian))}}"
                           class="btn btn-success btn-xs">
                            <span class="glyphicon glyphicon-align-left"></span> Lihat Ranking
                        </a>
                        </div> 
                        @else
                        <a href="{{action('Admin\SoalUjianController@show', array($userJawabLembar->id_nilai_ujian_pilgan, 0))}}"
                           class="btn btn-info btn-xs">
                            <span class="glyphicon glyphicon-play"></span> Lanjut Mengerjakan
                        </a>
                        @endif

                    </td>
                </tr>
                <?php $i++; endforeach  ?>                 
                </tbody>
            </table>
            @endif

              </div><!-- /.box-body -->            
            </div>
          <?php endif ?>          
        </div><!-- /.col -->
      </div><!-- /.row -->
       

@endsection
@section('script')

<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
      $(function () {

        $('#dataTabelUjian').DataTable({"pageLength": 10, "scrollX": true});
        $('#dataTabelUjianSiswa').DataTable({"pageLength": 10, "scrollX": true});
        $('#dataTabelPengambilanUjianSiswa').DataTable({"pageLength": 10, "scrollX": true});
      });

    </script>

@endsection