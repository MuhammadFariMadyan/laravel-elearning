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
          <div class="row">
          <div class="col-md-12">
           <div class="uk-alert uk-alert-success" data-uk-alert>
                <a href="" class="uk-alert-close uk-close"></a>
                <p>{{  isset($successMessage) ? $successMessage : '' }}</p>
                 @if (count($errors) > 0)
                    <div class="alert alert-danger" align="center">
                        <strong>Maaf!</strong> Sebelum Menekan tombol "Simpan" Anda Harus Melengkapi data dibawah ini dahulu :
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

           <div class="box box-danger">
              <div class="box-header with-border">
              <h3 class="box-title"> Form Edit Data Nilai Tugas</h3>              
           </div>

        <div style="display: block; " class="box-body">                         
                       <form id="formNilaiTugasEdit" class="form-horizontal" role="form" method="POST" action="{{ url('admin/nilai_tugas/'.$id_nilai_tugas_siswa.'/simpanedit') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="id_nilai_tugas_siswa" value="{{$id_nilai_tugas_siswa}}" >

                      <div class="form-group">
                       <label class="col-md-3 control-label">NISN Siswa</label>
                       <div class="col-md-8">               
                        <select class="form-control " name="nisn_siswa" style="font-size: 14px; text-align: left;">
                         <option value="{{ $nisn_siswa }}">-- {{ $nisn_siswa }} --</option>
                         @foreach ($Siswa as $idSiswa)
                            <option value="{{ $idSiswa->nisn_siswa }}">nisn siswa : {{ $idSiswa->nisn_siswa }} | nama : {{ $idSiswa->nama_siswa }}</option>
                         @endforeach                                                                                 
                        </select>
                       </div>   
                      </div>  

                      <div class="form-group">
                       <label class="col-md-3 control-label">ID Tugas</label>
                       <div class="col-md-8">               
                        <select class="form-control " name="id_tugas" style="font-size: 14px; text-align: left;">
                         <option value="{{ $id_tugas }}">-- {{ $id_tugas }}--</option>
                         @foreach ($Tugas as $idTugas)
                            <option value="{{ $idTugas->id_tugas }}">id tugas : {{ $idTugas->id_tugas }} | judul: {{ $idTugas->judul_tugas }}</option>
                         @endforeach                                                                                 
                        </select>
                       </div>   
                      </div>

                      <div class="form-group">
                         <label class="col-md-3 control-label">ID Mata Pelajaran</label>
                         <div class="col-md-8">               
                          <select class="form-control" name="id_mapel" style="font-size: 14px; text-align: left;">
                           <option value="{{ $id_mapel }}">-- {{ $id_mapel }}  --</option>
                           @foreach ($Mapel as $idMapel)
                              <option value="{{ $idMapel->id_mapel }}">id mata pelajaran : {{ $idMapel->id_mapel }} | nama : {{ $idMapel->nama_mapel }}</option>
                           @endforeach                                                                                 
                          </select>
                         </div>   
                        </div>

                      <div class="form-group">
                       <label class="col-md-3 control-label">Nilai Tugas</label>
                       <div class="col-md-8">               
                         <input type="text" class="form-control" name="nilai_tugas" value="{{ $nilai_tugas }}" >
                         <small class="help-block"></small>
                       </div>   
                      </div>
                      
                   </div><!-- /.box-body -->
                      <div style="display: block;" class="box-footer" >
                        <div class="form-group"> 
                           <div class="col-md-8 col-md-offset-5">
                             <button type="submit" class="btn btn-primary" id="button-reg" style="font-size: 14px; text-align: left;">
                                Simpan
                             </button>
                              <a href="{{{ action('Admin\NilaiTugasController@index') }}}" title="Cancel">
                                <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                              </a>  
                           </div>
                        </div>
                      </div><!-- /.box-footer-->
                    </form>   
                  </div>
                </div><!-- /.box -->
          </div><!-- /.row (main row) -->
                        
@endsection


