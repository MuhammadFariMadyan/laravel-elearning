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
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
                    <div class="pull-left">
                      <h3 class="box-title">Form Kirim SMS Pemberitahuan Tugas</h3>
                    </div>
                    <div class="pull-right">
                      <h3 class="box-title">Daftar Tugas &nbsp;&nbsp;<a href="{{{ URL::to('admin/tugas') }}}" class="btn btn-success btn-flat btn-sm" id="Tugas" title="Tugas"><i class="fa fa-list-ul"></i></a>&nbsp;&nbsp;</h3>
                    </div>
                </div>

                <div style="display: block;" class="box-body">
                  <form id="formSMSTambah" class="form-horizontal" role="form" method="POST" action="{{ url('admin/message/send') }}" >
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <label class="col-md-3 control-label"> Nomor Penerima </label>
                    <!-- <div class="col-md-8">
                        <input type="text" class="form-control" name="number" value="" placeholder="Nomor Penerima">
                        <small class="help-block"></small>
                    </div> -->
                    <div class="col-sm-8">
                    <select class="form-control " name="number" style="font-size: 14px; text-align: left;">
                     <option value="081215869294">081215869294</option>
                     <option value="all">All Number Siswa</option>
                     @foreach ($no_hp as $nomor)
                        <option value="{{ $nomor->no_hp_siswa }}">nomor : {{ $nomor->no_hp_siswa }} | nama : {{ $nomor->nama_siswa }}</option>
                     @endforeach
                    </select>
                   </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label"> Nama Kontak </label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="name" value="Tes" placeholder="Nama Kontak">
                      <small class="help-block"></small>
                  </div>
                  </div>

                  <div class="form-group">
                      <label for="message" class="col-md-3 control-label">Pesan</label>
                        <div class="col-md-8">
                          <textarea class="form-control" name="message" value="" placeholder="Pesan"></textarea>
                        </div>
                  </div>
                  </div><!-- /.box-body -->
                  <div style="display: block;" class="box-footer" >
                    <div class="form-group">
                      <div class="col-md-8 col-md-offset-5">
                        <button type="submit" class="btn btn-primary" id="button-reg">
                          Kirim Pesan
                        </button>
                      </div>
                    </div>
                  </div><!-- /.box-footer-->
                </form>
            </div><!-- /.box -->
          </div>
        </div><!-- /.row (main row) -->

@endsection 
