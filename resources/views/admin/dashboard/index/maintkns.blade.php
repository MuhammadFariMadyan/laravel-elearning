@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard Teknisi</li>
          </ol>
@stop
@section('content')

          <div class="callout callout-info">
        <h4>Selamat Datang Teknisi!</h4>
        <p>Untuk menggunakan SI Redis harap diperhatikan bagian-bagian data inti yang perlu dipersiapkan sebelumnya. Adapun fungsi di dalam Sistem Informasi Rekam Medis UPT. Puskesmas Talang Padang adalah sebagai berikut : </p>
    </div>
    
    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Menu di dalam Sistem ini terdiri dari :</h3>
              <div class="box-tools pull-right">
                <button data-original-title="Collapse" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div style="display: block;" class="box-body">
                <ul>
                <li>
                1. Data Pasien -> digunakan untuk...</li>
                <li>
                2. Data Rekam Medis -> digunakan untuk...</li>
                <li>
                3. Data Dokter -> digunakan untuk...</li>
                <li>                
                4. Data Resep -> digunakan untuk...</li>
                <li>
                5. Data Surat Rujuk -> digunakan untuk...</li>                                                                
                </ul>

            </div><!-- /.box-body -->
            <div style="display: block;" class="box-footer">
              nb : teknisi email => teknisi@gmail.com.
            </div><!-- /.box-footer-->
          </div>


             
@endsection
@section('script')



@endsection
