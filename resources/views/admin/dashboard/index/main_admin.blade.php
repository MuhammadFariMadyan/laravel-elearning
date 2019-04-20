@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard Admin
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard Admin</li>
          </ol>
@stop
@section('content')

    <div class="callout callout-danger" style="text-align: center; color: black;">
        <h3> <b>SISTEM INFORMASI E-LEARNING SMP PGRI 1 BANDAR LAMPUNG </b></h3>
        <h4 >Selamat Datang Admin!</h4>        
    </div>              

    <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{$countSiswa}}</h3>
                  <p>Data Siswa</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="{{url('admin/siswa')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola siswa">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{$countGuru}}</h3>
                  <p>Data Guru</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-plus"></i>
                </div>
                <a href="{{url('admin/guru')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Guru">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{$countMapel}}</h3>
                  <p>Mata Pelajaran</p>
                </div>
                <div class="icon">
                  <i class="fa fa-list-alt"></i>
                </div>
                <a href="{{url('admin/mapel')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Mata Pelajaran">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="{{url('admin/pengumuman')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Pengumuman">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->            
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
                <a href="{{url('admin/materi_ajar')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Materi Ajar">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="{{url('admin/tugas')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Tugas">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="{{url('admin/soal_ujian')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Soal Ujian">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="{{url('admin/ujian')}}" class="small-box-footer" data-toggle="tooltip" data-title="Kelola Ujian">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
  </div>
  
 
             
@endsection
@section('script')



@endsection
