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
                    <h3 class="box-title">Data Pasien - Tambah</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">

                      <form id="formPasienTambah" class="form-horizontal" role="form" method="POST" action="{{ url('admin/pasien/tambah') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      <div class="form-group">
                          <label class="col-md-4 control-label">Kode Pasien</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="kode_pasien" placeholder="PSNx">
                              <small class="help-block"></small>
                          </div>
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Nama </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="nama_pasien" placeholder="Nama Pasien">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Alamat </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="alamat" placeholder="Alamat Pasien">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">RT </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="rt" placeholder="RT">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">RW </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="rw" placeholder="RW">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Tanggal Lahir </label>
                          <div class="col-md-6">
                            {!! Form::date('tgl_lahir', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Tanggal Lahir']) !!}                              
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-4 control-label">Agama</label>
                          <div class="col-md-6">                               
                            <select class="form-control" name="agama">
                              <option value="0">- Pilih Agama -</option>
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
                              <option value="0">- Pilih Jenis Pembayaran -</option>
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
                              <input type="text" class="form-control" name="no_jaminan" placeholder="No Jaminan">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Pekerjaan </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Pendidikan Terakhir </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="pend_trkhr" placeholder="Pendidikan Terakhir">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Telp </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="telp" placeholder="Telpon">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Ortu/Suami </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="ortu_suami" placeholder="Ortu/Suami">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Istri/Anak </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="istri_anak" placeholder="Istri/Anak">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Alergi Obat </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="alergi_obat" placeholder="Alergi Obat">
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


