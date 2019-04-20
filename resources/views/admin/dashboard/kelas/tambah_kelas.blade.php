@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Kelas
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
                    <h3 class="box-title">Form Tambah Data Kelas</h3>
                  </div><!-- /.box-header -->
                  <div style="display: block; " class="box-body">

                  <form id="formKelasTambah" class="form-horizontal" role="form" method="POST" action="{{ url('admin/kelas/tambah') }}" >
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                  <div class="col-md-12" style="margin-left:8%;">
                      <div class="form-group">
                       <label class="col-sm-2  control-label" style="text-align: left;">Kelas</label>
                       <div class="col-sm-8">               
                        <select class="form-control " name="nama_kelas" style="font-size: 14px; text-align: left;">
                         <option value="{{ old('nama_kelas') }}">-- Pilih Kelas Siswa --</option>
                         <option value="VII A"> VII A </option>
                         <option value="VII B"> VII B </option>
                         <option value="VII C"> VII C </option>
                         <option value="VIII A"> VIII A </option>
                         <option value="VIII B"> VIII B </option>
                         <option value="VIII C"> VIII C </option>
                         <option value="IX A"> IX A </option>
                         <option value="IX B"> IX B </option>                   
                        </select>
                       </div>
                      </div>                      

                    <div class="form-group">
                     <label class="col-sm-2 control-label" style="text-align: left;">ID Mapel</label>
                     <div class="col-sm-8">               
                      <select class="form-control" name="id_mapel" style="font-size: 14px; text-align: left;">
                       <option value="">-- Pilih ID Mata Pelajaran  --</option>
                       @foreach ($Mapel as $idMapel)
                          <option value="{{ $idMapel->id_mapel }}">id mata pelajaran : {{ $idMapel->id_mapel }} | nama : {{ $idMapel->nama_mapel }}</option>
                       @endforeach                                                                                 
                      </select>
                     </div>   
                    </div>                     
                                            
                    </div>
                    </div><!-- /.box-body -->
                      <div style="display: block;" class="box-footer" >
                        <div class="form-group">
                          <div class="col-md-8 col-md-offset-5">
                              <button type="submit" class="btn btn-primary" id="button-reg">
                                  Simpan
                              </button>

                              <a href="{{{ action('Admin\KelasController@index') }}}" title="Cancel">
                              <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                              </a>  
                          </div>
                      </div>
                      </div><!-- /.box-footer-->
                      </form>   

                  
                </div><!-- /.box -->
            </div>
          </div><!-- /.row (main row) -->
                        
@endsection


