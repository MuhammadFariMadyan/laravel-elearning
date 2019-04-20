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
              <h3 class="box-title"> Form Tambah Data Nilai</h3>              
           </div>

        <div style="display: block; " class="box-body">

          <form id="formNilaiTambah" class="form-horizontal" role="form" method="POST" action="{{ url('admin/nilai/tambah') }}" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                       <label class="col-md-3 control-label">NISN Siswa</label>
                       <div class="col-md-8">               
                        <select class="form-control " name="nisn_siswa" style="font-size: 14px; text-align: left;">
                         <option value="">-- Pilih NISN Siswa --</option>
                         @foreach ($Siswa as $idSiswa)
                            <option value="{{ $idSiswa->nisn_siswa }}">nisn siswa : {{ $idSiswa->nisn_siswa }} | nama : {{ $idSiswa->nama_siswa }}</option>
                         @endforeach                                                                                 
                        </select>
                       </div>   
                      </div>

                      <div class="form-group">
                       <label class="col-md-3 control-label">ID Nilai Tugas</label>
                       <div class="col-md-8">               
                        <select class="form-control " name="id_nilai_tugas_siswa" style="font-size: 14px; text-align: left;">
                         <option value="">-- Pilih ID Nilai Tugas --</option>
                         @foreach ($NilaiTugas as $idNilaiTugas)
                            <option value="{{ $idNilaiTugas->id_nilai_tugas_siswa }}">nisn siswa : {{ $idNilaiTugas->id_nilai_tugas_siswa }} | nisn siswa : {{ $idNilaiTugas->nisn_siswa }}</option>
                         @endforeach                                                                                 
                        </select>
                       </div>   
                      </div>

                      <div class="form-group">
                       <label class="col-md-3 control-label">ID Nilai Ujian</label>
                       <div class="col-md-8">               
                        <select class="form-control " name="id_nilai_ujian_siswa" style="font-size: 14px; text-align: left;">
                         <option value="">-- Pilih ID Nilai Ujian --</option>
                         @foreach ($NilaiUjian as $idNilaiUjian)
                            <option value="{{ $idNilaiUjian->id_nilai_ujian_siswa }}">nisn siswa : {{ $idNilaiUjian->id_nilai_ujian_siswa }} | nisn siswa : {{ $idNilaiUjian->nisn_siswa }}</option>
                         @endforeach                                                                                 
                        </select>
                       </div>   
                      </div>
                      
                   </div><!-- /.box-body -->
                      <div style="display: block;" class="box-footer" >
                        <div class="form-group"> 
                           <div class="col-md-8 col-md-offset-5">
                             <button type="submit" class="btn btn-primary" id="button-reg" style="font-size: 14px; text-align: left;">
                                Simpan
                             </button>
                              <a href="{{{ action('Admin\NilaiController@index') }}}" title="Cancel">
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


