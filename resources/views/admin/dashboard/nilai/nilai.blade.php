@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Nilai Siswa
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
            <li class="active">Nilai Siswa</li>           
          </ol>
@stop
@section('content')
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <div class="box-header">               
                    <form id="formKelasMapel" class="form-horizontal" role="form" method="POST" action="{{ route('admin.nilai_siswa.kelas.mapel')}}");>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label class="col-md-4 control-label">Pilihan Kelas</label>
                      <div class="col-md-4">  
                        <select class="form-control " name="kelas_terpilih" style="font-size: 14px; text-align: left;">
                         @foreach ($listKelas as $dataKelas)
                          <option value="{{$dataKelas}}"  @if($kelas_terpilih == $dataKelas) ? ' selected="selected"' : '' @endif > {{$dataKelas}}</option>                          
                         @endforeach
                        </select>                                          
                      <small class="help-block"></small>
                      </div>                          
                      <div class="col-md-4">                         
                          <button type="submit" class="btn btn-flat btn-social btn-dropbox" id="button-reg">
                                <i class="fa  fa-hand-o-left"></i> Pilih
                          </button>
                      </div>                         
                    </div>
                    </form>                
                  </div><!-- /.box-header -->                
                <div class="box-body"> 
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#nilai_tugas" data-toggle="tab">Nilai Tugas</a></li>
                  <li ><a href="#nilai_ujian" data-toggle="tab">Nilai Ujian</a></li>
                </ul>

                <!-- Tab panes 1 -->
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="nilai_tugas">
                    <br/>                    
                    @if (!count($nilaiTugas)<=1)
                    <table id="dataTabelNilaiTugas" class="table table-bordered table-hover">
                      <thead>
                        <tr>      
                          <th >No</th>
                          <th>Kelas</th> 
                          <th style="width: 15%;">Mata Pelajaran</th>
                          <th style="width: 30%;">Judul Tugas</th>
                          <th>NISN</th>                                     
                          <th>Nama Siswa</th>                        
                          <th>Nilai Tugas</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i=1; foreach ($nilaiTugas as $dataNilaiTugas):  ?>
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$dataNilaiTugas->kelas_tugas}}</td>
                          <td>{{$dataNilaiTugas->nama_mapel}}</td>
                          <td>{{$dataNilaiTugas->judul_tugas}}</td>
                          <td>{{$dataNilaiTugas->nisn_siswa}}</td>
                          <td>{{$dataNilaiTugas->nama_siswa}}</td>                        
                          <td>{{$dataNilaiTugas->nilai}}</td>                                                    
                        </tr>
                        <?php $i++; endforeach  ?> 
                      </tbody>
                    </table>
                    @endif                   
                  </div>
                  <div class="tab-pane fade" id="nilai_ujian">
                    <br/>                    
                    @if (!count($nilaiUjian)<=1)
                    <table id="dataTabelNilaiUjian" class="table table-bordered table-hover">
                      <thead>
                        <tr>      
                          <th >No</th>
                          <th>Kelas</th> 
                          <th style="width: 15%;">Mata Pelajaran</th>
                          <th style="width: 30%;">Judul Ujian</th>
                          <th>Jenis</th>                                     
                          <th>NISN</th> 
                          <th>Nama Siswa</th>                        
                          <th>Nilai Ujian</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i=1; foreach ($nilaiUjian as $dataNilaiUjian):  ?>
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$dataNilaiUjian->kelas_ujian}}</td>
                          <td>{{$dataNilaiUjian->nama_mapel}}</td>
                          <td>{{$dataNilaiUjian->judul_ujian}}</td>
                          <td>{{$dataNilaiUjian->jenis_ujian}}</td>
                          <td>{{$dataNilaiUjian->nisn_siswa}}</td>
                          <td>{{$dataNilaiUjian->nama_siswa}}</td>                        
                          <td>{{$dataNilaiUjian->nilai}}</td>                                                    
                        </tr>
                        <?php $i++; endforeach  ?> 
                      </tbody>
                    </table>
                    @endif                    
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
        $('#dataTabelNilaiTugas').DataTable({"pageLength": 10}); //, "scrollX": true
        $('#dataTabelNilaiUjian').DataTable({"pageLength": 10}); //, "scrollX": true

      });

    </script>

@endsection

