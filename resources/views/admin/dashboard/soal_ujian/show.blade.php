@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Ujian Online
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Siswa</li>
            <li class="active">Ujian Online</li>
          </ol>
@stop
@section('content') 
<!-- Main component for a primary marketing message or call to action -->

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>{{$nomor}}
            <small>/ {{count($all_soal_ids)}}</small>              
            <div id="countdown" class="pull-right btn-danger btn " href="#" title="Sisa Waktu Mengerjakan" data-toggle="tooltip" style="width: 200px; height: 35px;"> <div id="status"></div> </div>
            <input type="text" id="until" name="until" value="{{$max_time}}" class="hidden">            
        </h2>
    </div>
    <div class="panel-body">

        @if (Session::has('messages'))
        @foreach (Session::get('messages') as $message)
        @if ($message[0] == 'error')
        <div class="alert alert-danger">{{$message[1]}}</div>
        @elseif ($message[0] == 'success')
        <div class="alert alert-success">{{$message[1]}}</div>
        @endif
        @endforeach
        @endif

        <div class="clearfix"></div>

        {{ Form::open(array('method' => 'put', 'role' => 'form', 'class' => 'form-horizontal', 'action' => array(
        'Admin\SoalUjianController@update', $userjawablembar->id_nilai_ujian_pilgan, $soal[0]->id_soal )) ) }}
        
        <div class="col-md-12">                

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
        
        <div class="col-md-12">
        <label for="Jawaban">Jawaban</label> 
        <div class="list-group">
            <a class="list-group-item well-lg">
                {{Form::radio('jawaban', $soal[0]->id_jawaban_soal_ujian)}}
                &nbsp;
                <strong>A.</strong> {{$soal[0]->jawaban}}
            </a>
            <a class="list-group-item well-lg">
                {{Form::radio('jawaban', $soal[1]->id_jawaban_soal_ujian)}}
                &nbsp;
                <strong>B.</strong> {{$soal[1]->jawaban}}
            </a>
            <a class="list-group-item well-lg">
                {{Form::radio('jawaban', $soal[2]->id_jawaban_soal_ujian)}}
                &nbsp;
                <strong>C.</strong> {{$soal[2]->jawaban}}
            </a>


            <a class="list-group-item well-lg">
                {{Form::radio('jawaban', $soal[3]->id_jawaban_soal_ujian)}}
                &nbsp;
                <strong>D.</strong> {{$soal[3]->jawaban}}

            </a>
        </div>        

        <div class="pull-right clearfix">
            @if (!$is_last_soal)
            <a href="{{action('Admin\SoalUjianController@show', array($userjawablembar->id_nilai_ujian_pilgan, $next_soal))}}"
               class="btn btn-default btn-sm">Lewati</a>
            @endif
            {{Form::submit($is_last_soal ? 'Lihat Hasil' : 'Lanjut', array('class' => 'btn btn-success btn-lg'))}}
        </div>
        </div>
        {{ Form::close()}}

    </div>
</div>
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#countdown').tooltip();
  });
</script>

<script>
// Set the date we're counting down to
// var countDownDate = new Date("2018/03/05 11:05:52").getTime(); // manual
var countDownDate1 = new Date(document.getElementById("until").value).getTime(); // from input text hidden

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate1 - now;

  // Time calculations for days, hours, minutes and seconds
  // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  // document.getElementById("status").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
  document.getElementById("status").innerHTML = hours + " jam " + minutes + " menit " + seconds + " detik ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
@endsection