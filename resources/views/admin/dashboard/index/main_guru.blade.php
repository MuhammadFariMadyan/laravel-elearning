@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard Guru
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard Guru</li>
          </ol>
@stop
@section('content')

    <div class="callout callout-danger" style="text-align: center; color: black;">
        <h3> <b>SISTEM INFORMASI E-LEARNING SMP PGRI 1 BANDAR LAMPUNG </b></h3>
        <h4 >Selamat Datang Guru!</h4>        
    </div>              

    <div class="row"> 
    <br><br><br><br><br><br>     
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue"> 
          <div class="inner">
            <h3>{{$countMateriAjar}}</h3>
            <p>Materi Ajar</p>
          </div>
          <div class="icon">
            <i class="fa fa-list-ol"></i>
          </div>
          <a href="{{url('guru/materi_ajar')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Materi Ajar">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>{{$countTugas}}</h3>
            <p>Tugas</p>
          </div>
          <div class="icon">
            <i class="fa fa-tasks"></i>
          </div>
          <a href="{{url('guru/tugas')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Tugas">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>{{$countSoal}}</h3>
            <p>Soal Ujian</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-text-o"></i>
          </div>
          <a href="{{url('guru/soal_ujian')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Soal Ujian">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>{{$countUjian}}</h3>
            <p>Ujian</p>
          </div>
          <div class="icon">
            <i class="fa fa-edit "></i>
          </div>
          <a href="{{url('guru/ujian')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Ujian">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
  </div>
             
@endsection
@section('script')



@endsection
