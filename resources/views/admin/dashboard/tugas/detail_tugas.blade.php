@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Detail Tugas 
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
            <li class="active">Detail Tugas</li>
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
              <div class="pull-left">
                  <h3 class="box-title">Upload file tugas mata pelajaran {{$tugas->nama_mapel}}</h3> 
              </div>                               
            </div><!-- /.box-header -->                
              <form id="formSiswaTugas" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('siswa/tugas/tambah') }}" >
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id_tugas" value="{{ $tugas->id_tugas }}">

              <div class="box-body">
                <div class="row">                   
                  <div class="col-md-11" style="margin-left:8%;">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="text-align: left;"> Judul </label>
                        <div class="col-sm-8"">
                            <input type="text" class="form-control" name="judul" placeholder="Judul File Tugas">
                            <small class="help-block"></small>
                        </div>
                    </div>                      

                    <div class="form-group" style="height: 48px">
                     <label class="col-sm-3  control-label" style="text-align: left;">Nama Materi</label>
                     <div class="col-sm-8">                  
                        <input type="file" id="materi_nama" name="nama_file" >
                        <p class="help-block">Pilih Nama File Materi Ajar. Ukuran maksimal 10 MB. </p>                                 
                     </div>
                    </div>
                  </div>
                </div><!-- /.row -->
                <div class="form-group">
                  <div class="col-md-8 col-md-offset-5">
                      <button type="submit" class="btn btn-primary" id="button-reg">
                          Simpan
                      </button>

                      <a href="{{ url('siswa/tugas') }}" title="Cancel">
                      <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                      </a>  
                  </div>
                </div>
              </form> 
                <hr> 
                @if ($siswaTugas->isEmpty())
                <div class="">
                  @if(!is_array($siswaTugas))
                  <div class="alert alert-warning" align="center" ><strong><font color="black">Anda belum melakukan upload file tugas</font></strong> </div>
                  @endif
                </div>
                @endif                 

                @if (!$siswaTugas->isEmpty())
                <table class="table table-hover table-responsive">
                    <thead>
                    <th width="10%">No</th>
                    <th width="35%">Judul tugas</th>
                    <th width="35%">Nama file</th>                   
                    <th width="20%">Aksi</th>
                    </thead>                    
                    <tbody> 
                    <?php $i=1; foreach ($siswaTugas as $siswaTugas):  ?>                   
                    <tr>                      
                        <td>{{$i}}</td>
                        <td>
                            {{$siswaTugas->judul}}
                        </td>
                        <td>
                            {{$siswaTugas->nama_file}}
                        </td>                        
                        <td> 
                            <div class="btn-group-horizontal">                              
                              <a href="{{{ URL::to('siswa/tugas/'.$siswaTugas->id_siswa_jawab_tugas.'/download_tugas_siswa') }}}" class="btn btn-primary btn-xs">
                                  <span class="fa fa-print"></span> Download
                              </a>
                              <a href="{{{ action('Admin\TugasController@hapus_tugas_siswa',[$siswaTugas->id_siswa_jawab_tugas]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus data {{{($i).' - '.($siswaTugas->judul) }}}?')" class="btn btn-danger btn-xs">
                                  <span class="glyphicon glyphicon-trash"></span> Delete
                              </a>
                            </div>                        
                        </td>                        
                    </tr>
                    <?php $i++; endforeach  ?>                    
                    </tbody>
                </table>
                @endif
              </div><!-- /.box-body -->                         
          </div>
        </div>                       
      </div><!-- /.row -->
@endsection
@section('script')

<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
      $(function () {

        $('#dataTableSoalUjian').DataTable({"pageLength": 10, "scrollX": true});
      });

</script>
<!-- <script type="text/javascript">
  $(document).ready(function() {
    $('#btnPopover1').tooltip();
    $('#btnPopover2').tooltip();
    $('#btnPopover3').tooltip();
    $('#btnPopover4').tooltip();
  });
</script> -->

@endsection

