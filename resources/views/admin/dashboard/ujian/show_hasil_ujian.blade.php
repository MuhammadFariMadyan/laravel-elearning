@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Detail Jawaban {{ $ujian->jenis_ujian }} Siswa
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
            <li class="active">Detail Jawaban {{ $ujian->jenis_ujian }} Siswa</li>
          </ol>
@stop
@section('content')          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $ujian->judul_ujian }}</h3>                  
                </div><!-- /.box-header -->                                                                
                <div class="box-body">
                  <div class="row"> 
                    <br/> 
                   <div class="col-md-12" style="margin-left: 12%;">                                    
                    <div class="col-md-5">                      
                     <table border="0" width="85%">                   
                      <tbody>
                        <tr>
                          <td width="30%"><strong>Mata Pelajaran</strong></td>  
                          <td>: &nbsp;&nbsp; {{$ujian->nama_mapel}}</td>                          
                        </tr>                        
                        <tr>
                          <td><strong>Jumlah Soal</strong></td> 
                          <td>: &nbsp;&nbsp; {{$ujian->jumlah_soal}}</td>
                        </tr>                        
                        <tr>
                          <td><strong>Batas Waktu</strong></td>
                          <td>: &nbsp;&nbsp; {{$ujian->waktu_ujian}} Menit</td>
                        </tr>
                        <tr>
                          <td><strong>Kelas</strong></td> 
                          <td>: &nbsp;&nbsp; {{$ujian->kelas_ujian}}</td>                        
                        </tr>
                        <tr>
                          <td><strong>Acak Soal</strong></td> 
                          <td>: &nbsp;&nbsp; {{$ujian->is_random ? 'Ya' : 'Tidak'}}</td> 
                        </tr>                                                                        
                      </tbody>                      
                    </table>
                  </div>                  
                  <div class="col-md-4" align="pull-right">                    
                   <div class="btn-default btn-lg pull-right" id="btnPopover1" title="Nilai Akhir" data-toggle="tooltip">
                      @if (!$userjawabujian->wkt_selesai)
                      <h1><span class="glyphicon glyphicon-play"></span></h1>
                      @else
                      <h1><span class="glyphicon glyphicon-ok"></span> {{$userjawabujian->nilai}}</h1>
                      @endif
                  </div>
                  <blockquote class="pull-right">
                      <div class="btn-default btn-xs pull-right" id="btnPopover2" title="NISN Siswa" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-user"></span> {{$userjawabujian->nisn_siswa}}
                      </div>
                      <div class="clearfix"></div>
                      <div class="btn-default btn-xs pull-right " id="btnPopover3" title="Diambil pada" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-time"></span> {{ date("d F Y
                          H:i:s",strtotime($userjawabujian->wkt_mulai)) }}
                      </div>
                      <div class="clearfix"></div>
                      <div class="btn-default btn-xs pull-right" id="btnPopover4" title="Selesai pada" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-time"></span> {{ date("d F Y
                          H:i:s",strtotime($userjawabujian->wkt_selesai)) }}
                      </div>
                      <div class="clearfix"></div>
                      <div class="btn-default btn-xs pull-right" id="btnPopover5" title="Waktu penyelesaian" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-time"></span> {{$interval}}
                      </div>
                  </blockquote>                      
                  </div>
                 </div>

                </div><!-- /.row -->
                @if ($userjawabujian->wkt_selesai)
                <hr/>                
                <!-- Jawaban group-->
                <blockquote>
                    <p>Riwayat Jawaban Siswa</p>
                </blockquote>
                <div class="panel-group" id="accordion">
                    @foreach ($userJawab as $key => $jawab)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#{{$jawab->id_siswa_jawab_ujian_pilgan}}" id="btnPopover6" title="{{$jawab->is_kosong ? 'Jawaban Kosong' : ($jawab->is_benar ? 'Jawaban Benar' : 'Jawaban Salah') }}" >
                                    @if ($jawab->is_kosong)
                                    <span class="glyphicon glyphicon-minus"></span>
                                    @elseif ($jawab->is_benar)
                                    <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                    <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                    Soal #{{$key + 1}}
                                </a>
                            </h4>
                        </div>
                        <div id="{{$jawab->id_siswa_jawab_ujian_pilgan}}" class="panel-collapse collapse">
                            <div class="panel-body">                                
                                <div class="form-group" >                                                                              
                                  <textarea class="form-control my-editor" name="pertanyaan" value="{{$jawab->pertanyaan}}" placeholder="Pertanyaan" style="height: 100px" >
                                    {{$jawab->pertanyaan}}
                                  </textarea>
                                  <small class="help-block"></small>                       
                                </div>                                
                                <?php 
                                  $jawabans = App\JawabanSoalUjian::where('id_soal', $jawab->id_soal)->get();
                                 ?>
                                <div class="list-group">
                                    <a class="list-group-item well-lg">
                                        @if($jawabans[0]->is_benar)
                                        <span class="glyphicon glyphicon-ok"></span>
                                        @else
                                        @endif
                                        <strong>A.</strong> {{$jawabans[0]->jawaban}}
                                        @if($jawabans[0]->id_jawaban_soal_ujian == $jawab->id_jawaban_soal_ujian)
                                        <span class="badge pull-right popover-hover" id="btnPopover7" title="Jawaban Anda" data-toggle="tooltip">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </span>
                                        @endif
                                    </a>
                                    <a class="list-group-item well-lg">
                                        @if($jawabans[1]->is_benar)
                                        <span class="glyphicon glyphicon-ok"></span>
                                        @else
                                        @endif
                                        <strong>B.</strong> {{$jawabans[1]->jawaban}}
                                        @if($jawabans[1]->id_jawaban_soal_ujian == $jawab->id_jawaban_soal_ujian)
                                        <span class="badge pull-right popover-hover" id="btnPopover7" title="Jawaban Anda" data-toggle="tooltip">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </span>
                                        @endif
                                    </a>
                                    <a class="list-group-item well-lg">
                                        @if($jawabans[2]->is_benar)
                                        <span class="glyphicon glyphicon-ok"></span>
                                        @else
                                        @endif
                                        <strong>C.</strong> {{$jawabans[2]->jawaban}}
                                        @if($jawabans[2]->id_jawaban_soal_ujian == $jawab->id_jawaban_soal_ujian)
                                        <span class="badge pull-right popover-hover" id="btnPopover7" title="Jawaban Anda" data-toggle="tooltip">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </span>
                                        @endif
                                    </a>
                                    <a class="list-group-item well-lg">
                                        @if($jawabans[3]->is_benar)
                                        <span class="glyphicon glyphicon-ok"></span>
                                        @else
                                        @endif
                                        <strong>D.</strong> {{$jawabans[3]->jawaban}}
                                        @if($jawabans[3]->id_jawaban_soal_ujian == $jawab->id_jawaban_soal_ujian)
                                        <span class="badge pull-right popover-hover" id="btnPopover7" title="Jawaban Anda" data-toggle="tooltip">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </span>
                                        @endif

                                    </a>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <br/>
                <br/>
                @endif
              
                @if (!$userjawabujian->wkt_selesai)
                <a href="{{action('Admin\SoalUjianController@show', array($userjawabujian->id_nilai_ujian_pilgan, 0))}}"
                   class="btn btn-info pull-right">
                    <span class="glyphicon glyphicon-play"></span> Lanjut Mengerjakan
                </a>
                @else                                                  
                <?php if (Auth::user()->level == 11 ): ?> 
                  <a href="{{ url('admin/siswa_ujian/'.$userjawabujian->id_ujian) }}"
                     class="btn btn-success pull-right">
                <?php endif ?>
                 <?php if (Auth::user()->level == 12): ?> 
                  <a href="{{ url('guru/siswa_ujian/'.$userjawabujian->id_ujian) }}"
                     class="btn btn-success pull-right">
                <?php endif ?>
                <?php if (Auth::user()->level == 13): ?>
                  <a href="{{ url('siswa/siswa_ujian/'.$userjawabujian->id_ujian) }}"
                     class="btn btn-success pull-right">
                <?php endif ?>
                      <span class="glyphicon glyphicon-align-left"></span> Lihat Ranking
                  </a>

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
<script type="text/javascript">
  $(document).ready(function() {
    $('#btnPopover1').tooltip();
    $('#btnPopover2').tooltip();
    $('#btnPopover3').tooltip();
    $('#btnPopover4').tooltip();
    $('#btnPopover5').tooltip();
    $('#btnPopover6').tooltip();
    $('#btnPopover7').tooltip();
  });
</script>
<script>
  var editor_config = {
    path_absolute : "{{ URL::to('/Arman/e-learning/public/') }}",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    image_advtab : true,
    readonly : 1,
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>

@endsection


