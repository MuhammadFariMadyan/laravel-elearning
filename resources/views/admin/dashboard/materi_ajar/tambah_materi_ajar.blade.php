@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Tambah Data Materi Ajar
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
            <li class="active">Tambah Data Materi Ajar</li>             
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
                    <h3 class="box-title"> Form Tambah Data Materi Ajar</h3>              
                </div>

                <div style="display: block; " class="box-body">                  
                  <?php if ( Auth::user()->level  == 11): ?>
                    <form id="formMateriAjarTambah" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/materi_ajar/tambah') }}" >
                  <?php endif ?>

                  <?php if (Auth::user()->level  == 12): ?>
                    <form id="formMateriAjarTambah_Guru" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('guru/materi_ajar/tambah') }}" >
                  <?php endif ?> 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                     <div class="col-md-11" style="margin-left:8%;">
                      <div class="form-group">
                          <label class="col-sm-3 control-label" style="text-align: left;"> Judul </label>
                          <div class="col-sm-8"">
                              <input type="text" class="form-control" name="materi_judul" placeholder="Judul Materi Ajar">
                              <small class="help-block"></small>
                          </div>
                      </div>                      

                    <div class="form-group" style="height: 48px">
                     <label class="col-sm-3  control-label" style="text-align: left;">Nama Materi</label>
                     <div class="col-sm-8">                  
                        <input type="file" id="materi_nama" name="materi_nama" >
                        <p class="help-block">Pilih Nama File Materi Ajar. Maks Ukuran 1 MB. </p>                                 
                     </div>
                    </div>

                      <div class="form-group">
                          <label class="col-sm-3 control-label" style="text-align: left;"> ID Materi Pelajaran </label>                          
                           <div class="col-sm-8"">               
                            <select class="form-control" name="id_mapel" style="font-size: 14px; text-align: left;">
                             <?php if ( Auth::user()->level  == 11): ?>
                               <option value=" ">-- Pilih ID Materi Pelajaran --</option>                             
                               @foreach ($dataMapel as $Mapel)
                                <option value="{{ $Mapel->id_mapel }}">id mata pelajaran : {{ $Mapel->id_mapel }} | nama mata pelajaran : {{ $Mapel->nama_mapel }}</option>
                               @endforeach
                            <?php endif ?>

                            <?php if (Auth::user()->level  == 12): ?>
                              <option value="{{ $dataMapel->id_mapel }}">-- id mata pelajaran : {{ $dataMapel->id_mapel }} | nama mata pelajaran : {{ $dataMapel->nama_mapel }} --</option>
                            <?php endif ?>
                            </select>
                           </div>        
                      </div> 

                      <div class="form-group">
                       <label class="col-sm-3 control-label" style="text-align: left;">Kelas</label>
                       <div class="col-sm-8">               
                        <select class="form-control" name="materi_kelas" style="font-size: 14px; text-align: left;">                         
                         <?php if ( Auth::user()->level  == 11): ?>
                           <option value="">-- Pilih Kelas --</option>
                           <option value="VII A"> VII A </option>
                           <option value="VII B"> VII B </option>
                           <option value="VII C"> VII C </option>
                           <option value="VIII A"> VIII A </option>
                           <option value="VIII B"> VIII B </option>
                           <option value="VIII C"> VIII C </option>
                           <option value="IX A"> IX A </option>
                           <option value="IX B"> IX B </option> 
                        <?php endif ?>

                        <?php if (Auth::user()->level  == 12): ?>
                          <option value="">-- Pilih Kelas --</option>                             
                          @foreach ($dataKelas as $Kelas)
                           <option value="{{ $Kelas->nama_kelas }}"> {{ $Kelas->nama_kelas }} </option>
                          @endforeach 
                        <?php endif ?>                   
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
                              
                              <?php if ( Auth::user()->level  == 11): ?>
                                <a href="{{{ url('admin/materi_ajar') }}}" title="Cancel">
                                <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                                </a> 
                              <?php endif ?>

                              <?php if (Auth::user()->level  == 12): ?>
                                <a href="{{{ url('guru/materi_ajar') }}}" title="Cancel">
                                <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                                </a> 
                              <?php endif ?> 
                          </div>
                      </div>
                    </div><!-- /.box-footer-->
                  </form>                                 
              </div><!-- /.box danger-->
            </div> <!-- col-md-12 -->
          </div><!-- /.row (main row) -->
                        
@endsection


