@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Pasien</li>
          </ol>
@stop
@section('content')
          <div class="row">
            <div class="col-md-6">
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
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Data Pasien - Edit</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                      <form id="formPasienEdit" class="form-horizontal" role="form" method="POST" action="{{ url('admin/pasien/'.$kode_pasien.'/simpanedit') }}" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="kode_pasien" value="{{$kode_pasien}}" >

                      <div class="form-group">
                          <label class="col-md-4 control-label">Kode Pasien</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="kode_pasien_show" value="{{$kode_pasien}}" disabled="true">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Nama </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="nama_pasien" value="{{$nama_pasien}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Alamat </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="alamat" value="{{$alamat}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">RT </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="rt" value="{{$rt}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">RW </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="rw" value="{{$rw}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Tanggal Lahir </label>
                          <div class="col-md-6">
                            {!! Form::date('tgl_lahir', $tgl_lahir, ['class' => 'form-control', 'placeholder' => 'Masukkan Tanggal Lahir']) !!}
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-4 control-label">Agama</label>
                          <div class="col-md-6">
                            <select class="form-control" name="agama">
                              <option value="{{$agama}}">- {{$agama}} -</option>
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Khatolik">Khatolik</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                              <option value="Lainnya">Lainnya</option>
                            </select>
                          </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Jenis Pembayaran</label>
                          <div class="col-md-6">
                            <select class="form-control" name="Jen_pmbyrn">
                              <option value="{{$Jen_pmbyrn}}">- {{$Jen_pmbyrn}} -</option>
                              <option value="Umum">Umum</option>
                              <option value="Jamkesmas">Jamkesmas</option>
                              <option value="Askes">Askes</option>
                              <option value="JKN">JKN</option>
                              <option value="Jamkemda">Jamkemda</option>
                              <option value="Gratis">Gratis</option>
                            </select>
                          </div>
                    </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">No Jaminan </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="no_jaminan" value="{{$no_jaminan}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Pekerjaan </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="pekerjaan" value="{{$pekerjaan}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Pendidikan Terakhir </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="pend_trkhr" value="{{$pend_trkhr}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Telp </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="telp" value="{{$telp}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Ortu/Suami </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="ortu_suami" value="{{$ortu_suami}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Istri/Anak </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="istri_anak" value="{{$istri_anak}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Alergi Obat </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="alergi_obat" value="{{$alergi_obat}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary" id="button-reg">
                                  Simpan
                              </button>


                              <a href="{{{ action('Admin\PasienController@index') }}}" title="Cancel">
                              <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                              </a>
                          </div>
                      </div>
                      </form>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
          </div><!-- /.row (main row) -->

@endsection


