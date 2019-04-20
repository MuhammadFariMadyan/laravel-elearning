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
      <h3 class="box-title"> Form Tambah Data Tugas</h3>              
    </div>

    <div style="display: block; " class="box-body">
      <form id="formTambahTugas" class="form-horizontal" role="form" method="POST" action="{{ url('admin/tugas/tambah') }}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
               
            <div class="col-md-6"> 
            <!-- general left form elements  -->
              <div class="form-group" >  
                <label class="col-sm-3 control-label" style="text-align: left;">Judul </label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="judul_tugas" value="" placeholder="Judul Tugas">
                    <small class="help-block"></small>
                 </div>
               </div>

               <div class="form-group">
                <label class="col-sm-3 control-label" style="text-align: left;">Deskripsi </label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="deskripsi_tugas" value="" placeholder="Deskripsi Tugas">
                    <small class="help-block"></small>            
                </div>  
                </div> 

              <div class="form-group">
                 <label class="col-sm-3 control-label" style="text-align: left;">Kelas</label>
                 <div class="col-sm-8">               
                  <select class="form-control" name="kelas_tugas" style="font-size: 14px; text-align: left;">
                   <option value="">-- Pilih Kelas Tugas --</option>
                   <option value="VII A"> VII A </option>
                   <option value="VII B"> VII B </option>
                   <option value="VII C"> VII C </option>
                   <option value="VIII A"> VIII A </option>
                   <option value="VIII B"> VIII B </option>
                   <option value="VIII C"> VIII C </option>
                   <option value="IX A"> IX A </option>
                   <option value="IX B"> IX B </option>                   
                  </select>
                 </div>
                </div>

                <div class="form-group" style="height: 42px">
               <label class="col-sm-3 control-label" style="text-align: left;">Waktu</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="waktu_tugas" value="" placeholder="Waktu Tugas / detik">
                    <small class="help-block"></small>
                 </div>
               </div>

               <div class="form-group">
                  <label class="col-sm-3 control-label" style="text-align: left;"> Pembuat </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" name="pembuat_tugas" value="{{ Auth::user()->name }}">
                      <small class="help-block"></small>
                  </div>
              </div>
            </div>

            <div class="col-md-6"> 
            <!-- general right form elements -->
              <div class="form-group" style="height: 46px">
                 <label class="col-sm-3 control-label" style="text-align: left;">Tanggal  </label>  
                 <div class="col-sm-8">          
                    <input type="text" class="form-control datepicker" name="tgl_tugas">
                 </div>
              </div>              

              <div class="form-group">
                 <label class="col-sm-3 control-label" style="text-align: left;">Info</label>
                 <div class="col-sm-8">                  
                    <input type="text" class="form-control" name="info_tugas" value="" placeholder="Info Tugas">
                    <small class="help-block"></small>
                 </div>
                </div>

              <div class="form-group">
                 <label class="col-sm-3 control-label" style="text-align: left;">Status Tugas</label>                   
                 <div class="col-sm-8">               
                  <select class="form-control" name="status_tugas" style="font-size: 14px; text-align: left;">
                   <option value="">-- Pilih Status Tugas --</option>
                   <option value="Aktif">Aktif</option>
                   <option value="Non Aktif">Non Aktif</option>                 
                  </select>
                 </div>
              </div>                                                                                  
                
              <div class="form-group">
               <label class="col-sm-3 control-label" style="text-align: left;">Status SMS</label>                                   
               <div class="col-sm-8">               
                <select class="form-control" name="sms_status_tugas" style="font-size: 14px; text-align: left;">
                 <option value="Belum Dikirim">-- Belum Dikirim --</option>
                 <!-- <option value="Sudah Dikirim">Sudah Terkirim</option> -->
                 <!-- <option value="Belum Dikirim">Belum Dikirim</option>                   -->
                </select>
               </div>
              </div>                 

              <div class="form-group">
               <label class="col-sm-3 control-label" style="text-align: left;">ID Mapel</label>
               <div class="col-sm-8">               
                <select class="form-control" name="id_mapel" style="font-size: 14px; text-align: left;">
                 <option value="">-- Pilih ID Mata Pelajaran  --</option>
                 @foreach ($Mapel as $idMapel)
                    <option value="{{ $idMapel->id_mapel }}">id mata pelajaran : {{ $idMapel->id_mapel }} | nama : {{ $idMapel->nama_mapel }}</option>
                 @endforeach                                                                                 
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
                    <a href="{{{ action('Admin\TugasController@index') }}}" title="Cancel">
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