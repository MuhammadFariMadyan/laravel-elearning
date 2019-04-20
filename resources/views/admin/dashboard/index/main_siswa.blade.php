@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard Siswa
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard Siswa</li>
          </ol>
@stop
@section('content')

    <div class="callout callout-danger" style="text-align: center; color: black;">
        <h3> <b>SISTEM INFORMASI E-LEARNING SMP PGRI 1 BANDAR LAMPUNG </b></h3>
        <h4 >Selamat Datang Siswa!</h4>        
    </div>              
    <br><br><br><br><br><br>
    <div class="row">
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue"> 
                <div class="inner">
                  <h3>{{$countMateriAjar}}</h3>
                  <p>Materi Mata Pelajaran</p>
                </div>
                <div class="icon">
                  <i class="fa fa-list-ol"></i>
                </div>
                <a href="{{url('siswa/materi_ajar')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Materi Ajar">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{$countPengumuman}}</h3>
                  <p>Pengumuman</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bullhorn"></i>
                </div>
                <a href="{{url('siswa/pengumuman')}}" class="small-box-footer" data-toggle="tooltip" data-title="Lihat Pengumuman apa yang sedang Terbaru disini">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="{{url('siswa/tugas')}}" class="small-box-footer" data-toggle="tooltip" data-title="Lihat Tugas kamu disini">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="{{url('siswa/ujian')}}" class="small-box-footer" data-toggle="tooltip" data-title="Lihat Ujian kamu disini">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
  </div>
             
@endsection
@section('script')



@endsection
