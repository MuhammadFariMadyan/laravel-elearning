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
      <h3 class="box-title"> Form Tambah Data Guru</h3>              
    </div>
    
    <div style="display: block;" class="box-body">
      <form id="formGuruTambah" class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{ url('admin/guru/tambah') }}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="col-md-12" style="margin-left:2%;">                     
          <div class="col-md-6">
            <!-- general left form elements  nisn email jk kelas id user status --> 
            <div class="form-group">
                <label class="col-sm-4 control-label" style="text-align: left;">NIP</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="nip_guru" value="" placeholder="NIP">
                    <small class="help-block"></small>
                 </div>
               </div>

              <div class="form-group">
                <label class="col-sm-4 control-label" style="text-align: left;">Nama</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="nama_guru" value="" placeholder="Nama">
                    <small class="help-block"></small>            
                </div>  
              </div>

              <div class="form-group" style="height: 42px">
                 <label class="col-sm-4 control-label" style="text-align: left;">Tempat Tanggal Lahir </label>            
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="ttl_guru" value="" placeholder="Tempat Tanggal Lahir">
                    <small class="help-block"></small>
                 </div>
              </div> 

              <div class="form-group" style="height: 44px">
                 <label class="col-sm-4 control-label" style="text-align: left;">Jenis Kelamin</label>                   
                 <div class="col-sm-8">               
                  <select class="form-control " name="jns_kelamin_guru" style="font-size: 14px; text-align: left;">
                   <option>-- Pilih Jenis Kelamin --</option>
                   <option value="Laki - laki">Laki - laki</option>
                   <option value="Perempuan">Perempuan</option>                  
                  </select>
                 </div>
              </div> 

              <div class="form-group">
                  <label class="col-sm-4 control-label" style="text-align: left;">Agama</label>
                    <div class="col-sm-8">                               
                      <select class="form-control " name="agama_guru" style="font-size: 14px; text-align: left;">
                        <option value="0">-- Pilih Agama --</option>
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
                <label class="col-sm-4 control-label" style="text-align: left;">Nomor HP</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="no_telp_guru" value="" placeholder="Nomor HP">
                    <small class="help-block"></small>
                 </div>
               </div>

                <div class="form-group">
               <label class="col-sm-4 control-label" style="text-align: left;">Email</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="email_guru" value="" placeholder="Email">
                    <small class="help-block"></small>
                 </div>
               </div>
          </div>

          <div class="col-md-6">
            <!-- general left form elements  nisn email jk kelas id user status --> 
            <div class="form-group">
                 <label class="col-sm-3 control-label" style="text-align: left;">Alamat</label>
                 <div class="col-sm-8">
                  <textarea class="form-control" name="alamat_guru" placeholder="Alamat" style="height: 90px"></textarea>                              
                  <small class="help-block"></small>
                 </div>
               </div>                 

               <div class="form-group">
                 <label class="col-sm-3 control-label" style="text-align: left;">Jabatan</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="jabatan_guru" value="" placeholder="Jabatan Guru">
                    <small class="help-block"></small>
                 </div>
                </div>
                
                <div class="form-group" style="height: 48px">
                 <label class="col-sm-3  control-label" style="text-align: left;">Foto</label>
                 <div class="col-sm-8">                  
                    <input type="file" id="foto_guru" name="foto_guru" >
                    <p class="help-block">Pilih Foto Anda. Maks Ukuran 300x300. </p>                                 
                 </div>
                </div>

                <div class="form-group">
                 <label class="col-sm-3 control-label" style="text-align: left;">Status</label>                                   
                 <div class="col-sm-8">               
                  <select class="form-control " name="status_guru" style="font-size: 14px; text-align: left;">
                   <option>-- Pilih Status Guru --</option>
                   <option value="Aktif">Aktif</option>
                   <option value="Non Aktif">Non Aktif</option>                  
                  </select>
                 </div>
                </div>                 

                <div class="form-group">
                 <label class="col-sm-3 control-label" style="text-align: left;">ID USER</label>
                 <div class="col-sm-8">               
                  <select class="form-control " name="id_user" style="font-size: 14px; text-align: left;">
                   <option>-- Pilih ID User Guru --</option>
                   @foreach ($listIduser as $idUser)
                      <option value="{{ $idUser->id_user }}">id user : {{ $idUser->id_user }} | username : {{ $idUser->username }}</option>
                   @endforeach                                                                                 
                  </select>
                 </div>   
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
                    <a href="{{{ action('Admin\GuruController@index') }}}" title="Cancel">
                      <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                    </a>  
                 </div>
              </div>
            </div><!-- /.box-footer-->
        </form>
  </div>

  </div>
</div><!-- /.row (main row) -->
                        
@endsection


