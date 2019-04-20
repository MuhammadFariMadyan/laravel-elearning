@extends('admin.layout.master')
@section('breadcrump')
    <h1>
      Edit Data Soal Ujian
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
        <li class="active">Edit Data Soal Ujian</li>  
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
          <h3 class="box-title">Form Edit Data Soal Ujian </h3>
        </div>   
        <div class="pull-right"> 
          <a href="{{{ action('Admin\SoalUjianController@index') }}}" class="btn btn-success btn-xs">
              <span class="glyphicon glyphicon-th-list" ></span> Daftar Soal 
          </a> 
          <a href="{{{action('Admin\SoalUjianController@detail', [$id_soal]) }}}" class="btn btn-primary btn-xs">
              <span class="glyphicon glyphicon-eye-open"></span> Lihat
          </a>                
        </div> 
      </div><!-- /.box-header -->
      
    <div style="display: block;" class="box-body">                         
        <form id="formUjianEdit" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/soal_ujian/'.$id_soal.'/simpanedit') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id_soal" value="{{$id_soal}}" > 

          @if($jenis_soal == 'Pilihan Ganda')

             <div class="col-md-6" >
              <!-- general left form elements -->              
              <div class="form-group" style="height: 50px">                           
                  <label for="jenis_soal">Jenis Soal</label>                
                  <select class="form-control " name="jenis_soal">
                   <option value="{{$jenis_soal}}">-- {{$jenis_soal}} --</option>
                   <option value="Pilihan Ganda">Pilihan Ganda</option>
                   <!-- <option value="Essay">Essay</option>                   -->
                  </select>                         
              </div>                      

              <div class="form-group" >                       
               <label for="pertanyaan">Pertanyaan</label>                       
                <textarea class="form-control my-editor" name="pertanyaan" value="{{$pertanyaan}}" placeholder="Pertanyaan" style="height: 140px" >
                  {{$pertanyaan}}                  
                </textarea>
                <small class="help-block"></small>                       
              </div>

            <div class="form-group">                     
             <label for="gambar">Gambar</label>                     
                <input type="file" id="gambar" name="gambar" value="{{ $gambar }}">
                <p class="help-block">{{ $gambar }} </p>                                                      
            </div>                    
                                                                                                                                                      
            <!-- general left form elements -->
            </div>  
            <div class="col-md-6">
              <!-- general right form elements -->
              <div class="form-group"> 
              <div class="col-md-12">                    
                 <label for="id_ujian">ID Ujian</label>          
                  <select class="form-control " name="id_ujian">
                   <option value="{{$id_ujian}}">-- {{$id_ujian}} --</option>
                   @foreach ($ujian as $idUjian)
                      <option value="{{ $idUjian->id_ujian }}">id ujian : {{ $idUjian->id_ujian }} | {{ $idUjian->jenis_ujian }} | {{ $idUjian->nama_mapel }} </option>
                   @endforeach                                                                                 
                  </select>
                </div>
              </div>

              <blockquote>
                  <p>Daftar Jawaban</p>
              </blockquote>

              <div class="row" >
                  <div class="col-md-9" >
                      <div class="input-group input-group" style="height: 10px">
                          <span class="input-group-addon"><strong>A.</strong></span>                              
                          <textarea class="form-control" name="Jawaban_A" rows="2" style="height: 40px;" value="{{$jawaban[0]->jawaban}}">{{$jawaban[0]->jawaban}}</textarea>
                  <span class="input-group-addon">
                      {{Form::checkbox('a_is_benar', 1, old('a_is_benar') ? old('a_is_benar') : (int)$jawaban[0]->is_benar, array('id' => 'a_is_benar'))}}
            {{Form::label('a_is_benar', 'Benar', array('class' => 'control-label'))}}
                  </span>
                      </div>
                  </div>

                  <div class="col-md-3">
                      <div class="input-group input-group">
                          <span class="input-group-addon">Poin</span>
                          {{Form::text('Point_Jawaban_A', old('Point_Jawaban_A') ? old('Point_Jawaban_A') :
                (int)$jawaban[0]->poin,
                array('class' => 'form-control'))}}
                      </div>
                  </div>
              </div>

              <br/>

              <div class="row">
                  <div class="col-md-9" style="height: 10px">
                      <div class="input-group input-group">
                          <span class="input-group-addon"><strong>B.</strong></span>                              
                          <textarea class="form-control" name="Jawaban_B" rows="2" style="height: 40px;" value="{{$jawaban[1]->jawaban}}">{{$jawaban[1]->jawaban}}</textarea>
                  <span class="input-group-addon">
                      {{Form::checkbox('b_is_benar', 1, old('b_is_benar') ? old('b_is_benar') : (int)$jawaban[1]->is_benar, array('id' => 'b_is_benar'))}}
            {{Form::label('b_is_benar', 'Benar', array('class' => 'control-label'))}}
                  </span>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="input-group input-group">
                          <span class="input-group-addon">Poin</span>
                          {{Form::text('Point_Jawaban_B', old('Point_Jawaban_B') ? old('Point_Jawaban_B') :
                (int)$jawaban[1]->poin,
                array('class' => 'form-control'))}}
                      </div>
                  </div>
              </div>

              <br/>

              <div class="row"> 
                  <div class="col-md-9" style="height: 10px">
                      <div class="input-group input-group">
                          <span class="input-group-addon"><strong>C.</strong></span> 
                          <textarea class="form-control" name="Jawaban_C" rows="2" style="height: 40px;" value="{{$jawaban[2]->jawaban}}">{{$jawaban[2]->jawaban}}</textarea>
                  <span class="input-group-addon">
                      {{Form::checkbox('c_is_benar', 1, old('c_is_benar') ? old('c_is_benar') : (int)$jawaban[2]->is_benar, array('id' => 'c_is_benar'))}}
              {{Form::label('c_is_benar', 'Benar', array('class' => 'control-label'))}}
                  </span>
                      </div>
                  </div>


                  <div class="col-md-3">
                      <div class="input-group input-group">
                          <span class="input-group-addon">Poin</span>
                          {{Form::text('Point_Jawaban_C', old('Point_Jawaban_C') ? old('Point_Jawaban_C') :
                  (int)$jawaban[2]->poin,
                array('class' => 'form-control '))}}
                      </div>
                  </div>
              </div>

              <br/>

              <div class="row">
                  <div class="col-md-9" style="height: 10px">
                      <div class="input-group input-group">
                          <span class="input-group-addon"><strong>D.</strong></span>                              
                          <textarea class="form-control" name="Jawaban_D" rows="2" style="height: 40px;" value="{{$jawaban[3]->jawaban}}">{{$jawaban[3]->jawaban}}</textarea>
                  <span class="input-group-addon">
                      {{Form::checkbox('d_is_benar', 1, old('d_is_benar') ? old('d_is_benar') : (int)$jawaban[3]->is_benar, array('id' => 'd_is_benar'))}}
                      {{Form::label('d_is_benar', 'Benar', array('class' => 'control-label'))}}
                  </span>
                      </div>
                  </div>

                  <div class="col-md-3" >
                      <div class="input-group input-group">
                        <span class="input-group-addon">Poin</span>
                        {{Form::text('Point_Jawaban_D', old('Point_Jawaban_D') ? old('Point_Jawaban_D') : (int)$jawaban[3]->poin, array('class' => 'form-control '))}}  
                      </div>
                  </div>
              </div>
              <br/>
              <br/>
              <!-- general right form elements -->
            </div> 

            @elseif($jenis_soal == 'Essay')                        
              
              <div class="col-md-12">
              <!-- general left form elements -->              
                <div class="form-group" style="height: 50px">                           
                    <label for="jenis_soal">Jenis Soal</label>                
                    <select class="form-control " name="jenis_soal">
                     <option value="{{$jenis_soal}}">-- {{$jenis_soal}} --</option>
                     <option value="Pilihan Ganda">Pilihan Ganda</option>
                     <option value="Essay">Essay</option>                  
                    </select>                         
                </div>                      

                <div class="form-group" >                       
                 <label for="pertanyaan">Pertanyaan</label>                       
                  <textarea class="form-control my-editor" name="pertanyaan" value="{{$pertanyaan}}" placeholder="Pertanyaan" style="height: 140px" >
                    {{$pertanyaan}}
                  </textarea>
                  <small class="help-block"></small>                       
                </div>

              <div class="form-group">                     
               <label for="gambar">Gambar</label>                     
                  <input type="file" id="gambar" name="gambar" value="{{ $gambar }}">
                  <p class="help-block">{{ $gambar }} </p>                                                      
              </div>  

              <div class="form-group">                                  
                 <label for="id_ujian">ID Ujian</label>          
                  <select class="form-control " name="id_ujian">
                   <option value="{{$id_ujian}}">-- {{$id_ujian}} --</option>
                   @foreach ($ujian as $idUjian)
                      <option value="{{ $idUjian->id_ujian }}">id ujian : {{ $idUjian->id_ujian }} | {{ $idUjian->jenis_ujian }} | {{ $idUjian->nama_mapel }} </option>
                   @endforeach                                                                                 
                  </select>                
              </div>

              <!-- general left form elements -->
              </div> 

            @endif         
           
 
          </div><!-- /.box-body -->
        <div style="display: block;" class="box-footer" >
          <div class="form-group"> 
             <div class="col-md-8 col-md-offset-5">
               <button type="submit" class="btn btn-primary" id="button-reg">
                  Simpan
               </button>
                <a href="{{{ action('Admin\SoalUjianController@detail', [$id_soal]) }}}" title="Cancel">
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

