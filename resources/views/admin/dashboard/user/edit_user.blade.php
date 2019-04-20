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
            <div class="col-md-22">
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
                    <h3 class="box-title">Form Tambah Data Pengumuman</h3>
                </div><!-- /.box-header -->
                  <div style="display: block; " class="box-body">

                  <form id="formPengumumanEdit" class="form-horizontal" role="form" method="POST" action="{{ url('admin/user/'.$id_user.'/simpanedit') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="id_user" value="{{$id_user}}" > 
                  
                  <div class="col-md-12" style="margin-left:8%;">
                      <div class="form-group" >
                          <label class="col-md-2 control-label" style="text-align: left;"> Nama </label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="name" value="{{ $name }}" placeholder="Nama Pengguna">
                              <small class="help-block"></small>
                          </div>
                      </div>                    

                      <div class="form-group" >
                          <label class="col-md-2 control-label" style="text-align: left;"> Username </label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="username" value="{{ $username }}" placeholder="Username Pengguna">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group" >
                          <label class="col-md-2 control-label" style="text-align: left;"> Email </label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="email" value="{{ $email }}" placeholder="Email Pengguna">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <!-- <div class="form-group" >
                          <label class="col-md-2 control-label" style="text-align: left;"> Password </label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="password" value="{{ $email }}" placeholder="Password Pengguna">
                              <small class="help-block"></small>
                          </div>
                      </div> -->

                      <div class="form-group">
                         <label class="col-md-2  control-label" style="text-align: left;">Jenis Hak Akses</label>                   
                         <div class="col-md-9">               
                          <select class="form-control " name="level" style="font-size: 14px; text-align: left;">
                           <option value="{{ $level }}">-- @if($level==11)
                            Admin
                          @elseif($level==12)
                            Guru
                          @elseif($level==13)
                            Siswa
                          @endif --</option>
                           <option value="11">Admin</option>
                           <option value="12">Guru</option>
                           <option value="13">Siswa</option>
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

                              <a href="{{{ action('AdminController@index_user') }}}" title="Cancel">
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


