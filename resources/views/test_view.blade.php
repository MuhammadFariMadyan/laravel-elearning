@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Ubah Password
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
            <li class="active">Ubah Password</li>
          </ol>
@stop
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Ubah Password</h3>                  
      </div><!-- /.box-header -->                                                                
      <div class="box-body">
        <div class="row"> 
          <br/>                   
          <form class="form-horizontal" role="form" method="POST" action="{{ url('user/store') }}">
                {{ csrf_field() }}                                           
                <div class="col-md-12" style="margin-left: 15%;">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label" style="text-align: left;">Nama</label>

                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control" name="name">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}" >
                    <label for="oldpassword" class="col-md-2 control-label" style="text-align: left;">Password Lama</label>

                    <div class="col-md-6">
                        <input id="oldpassword" type="password" class="form-control" name="oldpassword">

                        @if ($errors->has('oldpassword'))
                            <span class="help-block">
                                <strong>{{ $errors->first('oldpassword') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                    <label for="newpassword" class="col-md-2 control-label" style="text-align: left;">Password Baru</label>

                    <div class="col-md-6">
                        <input id="newpassword" type="password" class="form-control" name="newpassword">

                        @if ($errors->has('newpassword'))
                            <span class="help-block">
                                <strong>{{ $errors->first('newpassword') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('newpassword_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-2 control-label" style="text-align: left;">Konfirmasi Password Baru</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="newpassword_confirmation">

                        @if ($errors->has('newpassword_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('newpassword_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-refresh"></i> Reset Password
                        </button>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div><!-- /.box-body -->
      </div>
    </div>                       
  </div><!-- /.row -->
@endsection

