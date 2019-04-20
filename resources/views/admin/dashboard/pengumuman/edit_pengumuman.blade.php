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
                   <h3 class="box-title">Form Edit Data Pengumuman</h3>
                </div><!-- /.box-header -->
                  
                <div style="display: block; " class="box-body">                        
                 <form id="formPengumumanEdit" class="form-horizontal" role="form" method="POST" action="{{ url('admin/pengumuman/'.$id_pengumuman.'/simpanedit') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="id_pengumuman" value="{{$id_pengumuman}}" >                       

                  <div class="col-md-12" style="margin-left:8%;">
                      <div class="form-group" >
                          <label class="col-md-1 control-label" style="text-align: left;"> Judul </label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="judul" value="{{$judul}}">
                              <small class="help-block"></small>
                          </div>
                      </div>                      

                    <div class="form-group">
                      <label class="col-md-1 control-label" style="text-align: left;"> Deskripsi </label>
                      <div class="col-md-9">
                        <textarea class="form-control" name="deskripsi" rows="5"  value="{{$deskripsi}}">{{$deskripsi}}</textarea>                              
                        <small class="help-block"></small>
                    </div>
                      
                    </div>

                      <div class="form-group">
                          <label class="col-md-1 control-label" style="text-align: left;"> Author </label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="author" value="{{ Auth::user()->name }}" readonly="true">
                              <small class="help-block"></small>
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

                              <a href="{{{ action('Admin\PengumumanController@index') }}}" title="Cancel">
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


