@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Detail Soal Ujian 
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
            <li class="active">Detail Soal Ujian </li>
          </ol>
@stop
@section('content')         
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <div class="pull-left"> 
                    <h3 class="box-title">Detail Soal {{ $ujian[0]->judul_ujian }}</h3>                  
                  </div>   
                  <div class="pull-right"> 
                    <a href="{{{ action('Admin\SoalUjianController@index') }}}" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-th-list" ></span> Daftar Soal 
                    </a> 
                    <a href="{{{ URL::to('admin/soal_ujian/'.$id_soal.'/edit') }}}" class="btn btn-warning btn-xs">
                       <span class="glyphicon glyphicon-edit" ></span> Edit 
                    </a> 
                    <a href="{{{ action('Admin\SoalUjianController@hapus',[$id_soal]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus data {{{($pertanyaan).' - '.($ujian[0]->judul_ujian) }}}?')" class="btn btn-danger btn-xs">
                       <span class="glyphicon glyphicon-trash"></span> Delete
                    </a>                 
                  </div>                
                </div><!-- /.box-header -->                
                
                <div class="box-body">
                  <div class="row"> 
                    @if($jenis_soal == 'Pilihan Ganda')
                      <div class="col-md-11" style="margin-left: 4%;">                                                                                                       
                      
                      <?php if ($soal[0]->gambar == ""): ?>
                        <!-- Jika gambar di database soal ujian  "tidak ada" tampilkan pertanyaan  -->
                        <div class="form-group" >                                                                
                          <div class="col-md-12">                     
                           <label for="pertanyaan">Pertanyaan</label>                       
                            <textarea class="form-control my-editor" name="pertanyaan" value="{{$soal[0]->pertanyaan}}" placeholder="Pertanyaan" style="height: 100px" >
                              {{$soal[0]->pertanyaan}}                          
                            </textarea>                        
                            <small class="help-block"></small>                                               
                          </div>                                                                  
                        </div>
                      <?php endif ?>
                      <?php if (!$soal[0]->gambar == ""): ?>
                        <!-- Jika gambar di database soal ujian "ada" tampilkan gambar dan pertanyaan -->
                        <!--  gambar -->
                          <div class="form-group" >                                            
                            <div class="col-md-3">
                              <br>
                              <div class="textpanel" style="position: relative;">
                              <img src="{{ URL::to('upload_gambar/'.$soal[0]->gambar) }}" style="width: 210px; height: 210px; display: block;">
                                <!-- <img src="2kurungkurawalasset('/img/avatar04.png')2kurungkurawal" style="width: 210px; height: 210px; display: block;"> -->
                              </div>                           
                            </div>
                        <!-- Pertanyaan -->
                            <div class="col-md-9">                     
                             <label for="pertanyaan">Pertanyaan</label>                       
                              <textarea class="form-control my-editor" name="pertanyaan" value="{{$soal[0]->pertanyaan}}" placeholder="Pertanyaan" style="height: 100px" >
                                {{$soal[0]->pertanyaan}}                          
                              </textarea>                        
                              <small class="help-block"></small>                                               
                            </div>                                                                  
                          </div>
                      <?php endif ?>                                        
                     
                      <div class="form-group" > 
                      <div class="col-md-12">                       
                      <label for="Jawaban">Jawaban</label>                         
                        <div class="list-group">
                            <a class="list-group-item well-lg">
                                @if($soal[0]->is_benar)
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                <span class="glyphicon glyphicon-remove"></span>
                                @endif
                                <strong>A.</strong> {{$soal[0]->jawaban}}
                                <span class="badge">{{$soal[0]->poin}}</span>
                            </a>
                            <a class="list-group-item well-lg">
                                @if($soal[1]->is_benar)
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                <span class="glyphicon glyphicon-remove"></span>
                                @endif
                                <strong>B.</strong> {{$soal[1]->jawaban}}
                                <span class="badge">{{$soal[1]->poin}}</span>
                            </a>
                            <a class="list-group-item well-lg">
                                @if($soal[2]->is_benar)
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                <span class="glyphicon glyphicon-remove"></span>
                                @endif
                                <strong>C.</strong> {{$soal[2]->jawaban}}
                                <span class="badge">{{$soal[2]->poin}}</span>
                            </a>


                            <a class="list-group-item well-lg">
                                @if($soal[3]->is_benar)
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                <span class="glyphicon glyphicon-remove"></span>
                                @endif
                                <span class="badge">{{$soal[3]->poin}}</span>
                                <strong>D.</strong> {{$soal[3]->jawaban}}

                            </a>
                        </div>
                        </div>
                       </div>
                      </div>
                    @elseif($jenis_soal == 'Essay')
                      <div class="col-md-12">
                        <div class="form-group" >                       
                       <label for="pertanyaan">Pertanyaan</label>                       
                        <textarea class="form-control my-editor" name="pertanyaan" value="{{$pertanyaan}}" placeholder="Pertanyaan" style="height: 100px" >
                          {{$pertanyaan}}
                        </textarea>
                        <small class="help-block"></small>                       
                      </div>
                      </div>
                    @endif                     
                      

                  </div><!-- /.row -->                                  
                </div><!-- /.box-body -->                 
              </div>
            </div>                       
          </div><!-- /.row -->
@endsection
@section('script')
<script>
  var editor_config = {
    path_absolute : "{{ URL::to('/Arman/e-learning/public/') }}",
    selector: "textarea.my-editor",
    plugins: [],
    toolbar: "",
    // image_advtab : true,
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

