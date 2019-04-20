@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Tambah Data Ujian
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
            <li class="active">Tambah Data Ujian</li> 
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
      <h3 class="box-title"> Form Tambah Data Ujian</h3>              
    </div>
    
    <div style="display: block;" class="box-body">      
      <?php if ( Auth::user()->level  == 11): ?>
        <form id="formSiswaTambah" class="form-horizontal" role="form" method="POST" action="{{ url('admin/ujian/tambah') }}" >
      <?php endif ?>

      <?php if (Auth::user()->level  == 12): ?>
        <form id="formSiswaTambah" class="form-horizontal" role="form" method="POST" action="{{ url('guru/ujian/tambah') }}" >
        </a> 
      <?php endif ?>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         
          <div class="col-md-12" style="margin-left:0%;">
            <div class="col-md-6"> 
              <!-- general left form elements  --> 
               <div class="form-group">
                 <label class="col-sm-4 control-label" style="text-align: left;">Jenis Ujian</label>                                   
                 <div class="col-sm-8">               
                  <select class="form-control " name="jenis_ujian" style="font-size: 14px; text-align: left;">
                   <option value="">-- Pilih Jenis Ujian --</option>
                   <option value="Ujian Harian">Ujian Harian</option>
                   <option value="Ujian Mid">Ujian Mid</option>                  
                  </select>
                 </div>
                </div>

                <div class="form-group">
                 <label class="col-sm-4 control-label" style="text-align: left;">Kelas</label>
                 <div class="col-sm-8">               
                  <select class="form-control " name="kelas_ujian" style="font-size: 14px; text-align: left;">                   
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

                <div class="form-group">
                 <label class="col-sm-4 control-label" style="text-align: left;">ID Mapel</label>
                 <div class="col-sm-8">               
                  <select class="form-control " name="id_mapel" style="font-size: 14px; text-align: left;">                                              
                  <?php if ( Auth::user()->level  == 11): ?>
                     <option value="">-- Pilih ID Mata Pelajaran Siswa --</option>
                     @foreach ($Mapel as $idMapel)
                     <option value="{{ $idMapel->id_mapel }}">id mata pelajaran : {{ $idMapel->id_mapel }} | nama : {{ $idMapel->nama_mapel }}</option>
                     @endforeach
                  <?php endif ?>

                  <?php if (Auth::user()->level  == 12): ?>
                    <option value="{{ $dataMapel->id_mapel }}">-- id mata pelajaran : {{ $dataMapel->id_mapel }} | nama mata pelajaran : {{ $dataMapel->nama_mapel }} --</option>
                  <?php endif ?>
                  </select>
                 </div>   
                </div>

                <div class="form-group">
                <label class="col-sm-4 control-label" style="text-align: left;">Tanggal  </label>  
                <div class="col-sm-8">
                 <input type="text" class="form-control datepicker" name="tgl_ujian" style="height: 33px" placeholder="  Tanggal Ujian">
                </div>
              </div>

              <div class="form-group" style="height: 35px">
                  <label class="col-sm-4 control-label" style="text-align: left;"> Pembuat </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" name="pembuat_ujian" value="{{ Auth::user()->name }}" readonly="true" >
                      <small class="help-block"></small>
                  </div>
              </div>

              <div class="form-group" style="height: 35px">
                <label class="col-sm-4 control-label" style="text-align: left;">Nama </label> 
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="judul_ujian" value="" placeholder="Nama Ujian">
                    <small class="help-block"></small>
                 </div>
               </div> 
              <!-- general left form elements  -->
            </div>
            <div class="col-md-6"> 
              <!-- general right form elements -->
               <div class="form-group" >
                 <label class="col-sm-4 control-label" style="text-align: left;">Acak Soal</label>                   
                 <div class="col-sm-8">               
                  <select class="form-control " name="is_random" style="font-size: 14px; text-align: left;">
                   <option value="">-- Acak Soal ? --</option>
                   <option value="1">Ya</option>
                   <option value="0">Tidak</option>                 
                  </select>
                 </div>
              </div> 
              
               <div class="form-group" style="height: 35px">
               <label class="col-sm-4 control-label" style="text-align: left;">Waktu (Menit)</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="waktu_ujian" value="" placeholder="Waktu Ujian / Menit">
                    <small class="help-block"></small>
                 </div>
               </div>
              
              <div class="form-group" style="height: 30px">
                 <label class="col-sm-4 control-label" style="text-align: left;">Keterangan</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="info_ujian" value="" placeholder="Keterangan Ujian" style="height: 35px">
                    <small class="help-block"></small>
                 </div>
              </div>
              
              <div class="form-group" >
                 <label class="col-sm-4 control-label" style="text-align: left;">Status Ujian</label>                   
                 <div class="col-sm-8">               
                  <select class="form-control " name="status_ujian" style="font-size: 14px; text-align: left; height: 40px">
                   <option value="">-- Pilih Status Ujian --</option>
                   <option value="Aktif">Aktif</option>
                   <option value="Non Aktif">Non Aktif</option>                 
                  </select>
                 </div>
              </div>

              <div class="form-group" style="height: 30px">
                 <label class="col-sm-4 control-label" style="text-align: left;">Jumlah Soal</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="jumlah_soal" value="" placeholder="Jumlah Soal" style="height: 35px">
                    <small class="help-block"></small>
                 </div>
              </div>
              <!-- general right form elements -->
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
                      <a href="{{{ url('admin/ujian') }}}" title="Cancel">
                      <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                      </a> 
                    <?php endif ?>

                    <?php if (Auth::user()->level  == 12): ?>
                      <a href="{{{ url('guru/ujian') }}}" title="Cancel">
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

@section('script')

<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/select2/select2.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script>
   $(document).ready(function() {   
     $('.datepicker').datepicker({
                  todayBtn: "linked",
                  orientation: "left",
                  format: 'yyyy-mm-dd'
        });
    }); 
    
</script>
    
@endsection