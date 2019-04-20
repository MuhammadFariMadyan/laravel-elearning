@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Edit Biodata diri siswa
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>          
          <?php if ( Auth::user()->level  == 11): ?>
            <li class="active">Admin</li>                    
          <?php endif ?>
          <?php if (Auth::user()->level  == 13): ?>
            <li class="active">Siswa</li>             
          <?php endif ?>
            <li class="active">Edit Biodata diri siswa</li> 
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
      <h3 class="box-title">Form Edit Data Siswa</h3>              
    </div>
    
    <div style="display: block;" class="box-body">
    <?php if ( Auth::user()->level  == 11): ?>
      <form id="formSiswaEdit" class="form-horizontal" role="form" method="POST" files="true" enctype="multipart/form-data" action="{{ url('admin/siswa/'.$nisn_siswa.'/simpanedit') }}" >                    
    <?php endif ?>
    <?php if (Auth::user()->level  == 13): ?>
       <form id="formSiswaEdit" class="form-horizontal" role="form" method="POST" files="true" enctype="multipart/form-data" action="{{ url('siswa/siswa/simpanedit') }}" >           
    <?php endif ?>      
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="nisn_siswa" value="{{$nisn_siswa}}" >
          <div class="col-md-12" style="margin-left:2%;">
            <div class="col-md-6">
        <!-- general left form elements  nisn email jk kelas id user status -->              
              <div class="form-group">
                <label class="col-sm-4  control-label" style="text-align: left;">NISN</label>
                 <div class="col-sm-8"> 
                    <?php if ( Auth::user()->level  == 11): ?>
                      <input type="text" class="form-control" name="nisn_siswa" value="{{$nisn_siswa}}">
                    <?php endif ?>
                    <?php if (Auth::user()->level  == 13): ?>
                      <input type="text" class="form-control" name="nisn_siswa" value="{{$nisn_siswa}}" readonly="true">
                    <?php endif ?>                                      
                    <small class="help-block"></small>
                 </div>
              </div>
              <div class="form-group">
              <label class="col-sm-4  control-label" style="text-align: left;">Nama</label>
              <div class="col-sm-8">                  
                <input type="text" class="form-control" name="nama_siswa" value="{{$nama_siswa}}">
                <small class="help-block"></small>            
              </div>      
              </div>
              <div class="form-group">
               <label class="col-sm-4  control-label" style="text-align: left;">Email</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="email_siswa" value="{{$email_siswa}}">
                    <small class="help-block"></small>
                 </div>
               </div>        
              <div class="form-group">
                 <label class="col-sm-4  control-label" style="text-align: left;">Jenis Kelamin</label>                   
                 <div class="col-sm-8">               
                  <select class="form-control " name="jns_kelamin_siswa" style="font-size: 14px; text-align: left;">
                   <option value="{{$jns_kelamin_siswa}}">-- {{$jns_kelamin_siswa}} --</option>
                   <option value="Laki - laki">Laki - laki</option>
                   <option value="Perempuan">Perempuan</option>                  
                  </select>
                 </div>
              </div>
              <div class="form-group" style="height: 35px">
               <label class="col-sm-4  control-label" style="text-align: left;">Tempat Tanggal Lahir</label>            
               <div class="col-sm-8">                  
                  <input type="text" class="form-control" name="ttl_siswa" value="{{$ttl_siswa}}">
                  <small class="help-block"></small>
               </div>
              </div>               
              <div class="form-group" >
               <label class="col-sm-4  control-label" style="text-align: left;">Nomor HP</label>
               <div class="col-sm-8">                  
                  <input type="text" class="form-control" name="no_hp_siswa" value="{{$no_hp_siswa}}">
                  <small class="help-block"></small>
               </div>
              </div>                                                                                                                                                                                              
        <!-- general left form elements -->
        </div>   

        <div class="col-md-6">
          <!-- general rigth form elements --> 
            <div class="form-group" style="height: 48px">
             <label class="col-sm-3  control-label" style="text-align: left;">Foto</label>
             <div class="col-sm-8">                  
                <input type="file" id="foto_siswa" name="foto_siswa" value="{!! old('foto_siswa', $foto_siswa) !!}">
                <p class="help-block">-- {!! old('foto_siswa', $foto_siswa) !!} --</p>                                 
             </div>
            </div>
            <div class="form-group">
             <label class="col-sm-3  control-label" style="text-align: left;">Alamat</label>
             <div class="col-sm-8">
              <textarea class="form-control" name="alamat_siswa" value="{{$alamat_siswa}}" style="height: 90px">{{$alamat_siswa}}</textarea>                              
              <small class="help-block"></small>
             </div>
            </div>
            <div class="form-group">
             <label class="col-sm-3  control-label" style="text-align: left;">Kelas</label>
             <div class="col-sm-8">               
              <select class="form-control " name="kelas_siswa" style="font-size: 14px; text-align: left;">               
              <?php if ( Auth::user()->level  == 11): ?>
               <option value="{{$kelas_siswa}}">-- {{$kelas_siswa}} --</option>
               <option value="VII A"> VII A </option>
               <option value="VII B"> VII B </option>
               <option value="VII C"> VII C </option>
               <option value="VIII A"> VIII A </option>
               <option value="VIII B"> VIII B </option>
               <option value="VIII C"> VIII C </option>
               <option value="IX A"> IX A </option>
               <option value="IX B"> IX B </option> 
              <?php endif ?>
              <?php if (Auth::user()->level  == 13): ?>
                <option value="{{$kelas_siswa}}">-- {{$kelas_siswa}} --</option>
              <?php endif ?>                   
              </select>
             </div>
            </div>
          <div class="form-group">
             <label class="col-sm-3  control-label" style="text-align: left;">Status</label>                                   
             <div class="col-sm-8">               
              <select class="form-control " name="status_siswa" style="font-size: 14px; text-align: left;">               
              <?php if ( Auth::user()->level  == 11): ?>
                <option value="{{$status_siswa}}">-- {{$status_siswa}} --</option>
                <option value="Aktif">Aktif</option>
                <option value="Non Aktif">Non Aktif</option>
              <?php endif ?>
              <?php if (Auth::user()->level  == 13): ?>
                <option value="{{$status_siswa}}">-- {{$status_siswa}} --</option>
              <?php endif ?>                                
              </select>
             </div>
            </div>                 
            <div class="form-group">
             <label class="col-sm-3  control-label" style="text-align: left;">ID USER</label>
             <div class="col-sm-8">               
              <select class="form-control " name="id_user" style="font-size: 14px; text-align: left;">               
              <?php if ( Auth::user()->level  == 11): ?>
                <option value="{{$id_user}}">-- id user : {{ $id_user }} | username : {{ $nisn_siswa }} --</option>
                @foreach ($userData as $User)
                  <option value="{{ $User->id_user }}">id user : {{ $User->id_user }} | username : {{ $User->username }}</option>
                @endforeach 
              <?php endif ?>
              <?php if (Auth::user()->level  == 13): ?>
                <option value="{{$id_user}}">-- id user : {{ $id_user }} | username : {{ $nisn_siswa }} --</option>
              <?php endif ?> 
              </select>
             </div>   
            </div>
          <!-- general rigth form elements -->
        </div>        
      </div>                                                    
       
              </div><!-- /.box-body -->
            <div style="display: block;" class="box-footer" >
              <div class="form-group"> 
                 <div class="col-md-8 col-md-offset-5">
                   <button type="submit" class="btn btn-primary" id="button-reg">
                      Simpan
                   </button>
                    <?php if ( Auth::user()->level  == 11): ?> 
                    <a href="{{{ action('Admin\SiswaController@index') }}}" title="Cancel">
                      <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                    </a> 
                    <?php endif ?> 
                    <?php if ( Auth::user()->level  == 13): ?> 
                    <a href="{{{ URL::to('siswa/siswa/'.$nisn_siswa.'/detail') }}}" title="Cancel">
                      <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                    </a>
                   <?php endif ?> 
                 </div>
              </div>
            </div><!-- /.box-footer-->

        </form>

    </div>


            </div>
          </div><!-- /.row (main row) -->
                        
@endsection