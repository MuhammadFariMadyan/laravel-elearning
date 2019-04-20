@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Tambah Data Soal Ujian
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
              <li class="active">Tambah Data Soal Ujian</li>
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
        <h3 class="box-title"> Form Tambah Data Soal Ujian</h3>
      </div>   
      <div class="pull-right"> 
        <a href="{{{ action('Admin\SoalUjianController@index') }}}" class="btn btn-success btn-xs">
            <span class="glyphicon glyphicon-th-list" ></span> Daftar Soal 
        </a>         
      </div>              
    </div>
    
    <div style="display: block;" class="box-body">
      <form id="formSoalUjianTambah" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/soal_ujian/tambah') }}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">                    
                
                <div class="col-md-6" >
                <!-- general left form elements -->              
                      <div class="form-group" style="height: 50px">                           
                          <label for="jenis_soal">Jenis Soal</label>                
                          <select class="form-control " name="jenis_soal">
                           <option value="Pilihan Ganda">-- Pilihan Ganda --</option>
                           <!-- <option value="Pilihan Ganda">Pilihan Ganda</option> -->
                           <!-- <option value="Essay">Essay</option>                   -->
                          </select>                         
                      </div>                      

                      <div class="form-group" >                       
                       <label for="pertanyaan">Pertanyaan</label>                       
                        <textarea class="form-control my-editor" name="pertanyaan" value="{{ old('pertanyaan') }}" placeholder="Pertanyaan" style="height: 140px"></textarea>
                        <small class="help-block"></small>                       
                      </div>

                    <div class="form-group">                     
                     <label for="gambar">Gambar</label>                     
                        <input type="file" id="gambar" name="gambar" value="{{ old('id_ujian') }}">
                        <p class="help-block">Pilih Gambar dengan Maks Ukuran 300x300. </p>                                                      
                    </div>                    
                                                                                                                                                              
                <!-- general left form elements -->
                </div>  

                <div class="col-md-6">
                  <div class="form-group"> 
                  <div class="col-md-12">                    
                     <label for="id_ujian">ID Ujian</label>          
                      <select class="form-control " name="id_ujian">
                       <option value="{{ old('id_ujian') }}">-- Pilih ID Ujian --</option>
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
                              <textarea class="form-control" name="Jawaban_A" rows="2" style="height: 40px;" value="{{old('Jawaban_A')}}"></textarea>
                      <span class="input-group-addon">
                          {{Form::checkbox('a_is_benar', 1,  old('a_is_benar') , array('id' => 'a_is_benar'))}}
                          {{Form::label('a_is_benar', 'Benar', array('class' => 'control-label'))}}
                      </span>
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="input-group input-group">
                              <span class="input-group-addon">Poin</span>
                              {{Form::text('Point_Jawaban_A',  old('Point_Jawaban_A')  ?  old('Point_Jawaban_A')  : 0,
                              array('class' => 'form-control '))}}
                          </div>
                      </div>
                  </div>

                  <br/>

                  <div class="row">
                      <div class="col-md-9" style="height: 10px">
                          <div class="input-group input-group">
                              <span class="input-group-addon"><strong>B.</strong></span>                              
                              <textarea class="form-control" name="Jawaban_B" rows="2" style="height: 40px;" value="{{old('Jawaban_B')}}"></textarea>
                      <span class="input-group-addon">
                          {{Form::checkbox('b_is_benar', 1,  old('b_is_benar') , array('id' => 'b_is_benar'))}}
                          {{Form::label('b_is_benar', 'Benar', array('class' => 'control-label'))}}
                      </span>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="input-group input-group">
                              <span class="input-group-addon">Poin</span>
                              {{Form::text('Point_Jawaban_B',  old('Point_Jawaban_B')  ?  old('Point_Jawaban_B')  : 0,
                              array('class' => 'form-control '))}}
                          </div>
                      </div>
                  </div>

                  <br/>

                  <div class="row"> 
                      <div class="col-md-9" style="height: 10px">
                          <div class="input-group input-group">
                              <span class="input-group-addon"><strong>C.</strong></span> 
                              <textarea class="form-control" name="Jawaban_C" rows="2" style="height: 40px;" value="{{old('Jawaban_C')}}"></textarea>
                      <span class="input-group-addon">
                          {{Form::checkbox('c_is_benar', 1,  old('c_is_benar') , array('id' => 'c_is_benar'))}}
                          {{Form::label('c_is_benar', 'Benar', array('class' => 'control-label'))}}
                      </span>
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="input-group input-group">
                              <span class="input-group-addon">Poin</span>
                              {{Form::text('Point_Jawaban_C',  old('Point_Jawaban_C')  ?  old('Point_Jawaban_C')  : 0,
                              array('class' => 'form-control '))}}
                          </div>
                      </div>
                  </div>

                  <br/>

                  <div class="row">
                      <div class="col-md-9" style="height: 10px">
                          <div class="input-group input-group">
                              <span class="input-group-addon"><strong>D.</strong></span>                              
                              <textarea class="form-control" name="Jawaban_D" rows="2" style="height: 40px;" value="{{old('Jawaban_D')}}"></textarea>
                      <span class="input-group-addon">
                          {{Form::checkbox('d_is_benar', 1,  old('d_is_benar') , array('id' => 'd_is_benar'))}}
                          {{Form::label('d_is_benar', 'Benar', array('class' => 'control-label'))}}
                      </span>
                          </div>
                      </div>

                      <div class="col-md-3" >
                          <div class="input-group input-group">
                              <span class="input-group-addon">Poin</span>
                              {{Form::text('Point_Jawaban_D',  old('Point_Jawaban_D')  ?  old('Point_Jawaban_D')  : 0,
                              array('class' => 'form-control '))}}
                          </div>
                      </div>
                  </div>
                  <br/>
                  <br/>
                </div>                 
                
              </div><!-- /.box-body -->
            <div style="display: block;" class="box-footer" >
              <div class="form-group"> 
                 <div class="col-md-8 col-md-offset-5">
                   <button type="submit" class="btn btn-primary" id="button-reg">
                      Simpan
                   </button>
                    <a href="{{{ action('Admin\SoalUjianController@index') }}}" title="Cancel">
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
      "advlist autolink lists charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
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
