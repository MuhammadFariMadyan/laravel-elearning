@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard Admin</li>
          </ol>
@stop
@section('content')

    <div class="callout callout-info">
        <h4>Selamat Datang Admin!</h4>
        <p> E-Learning SMPN PGRI 1 Bandar Lampung: </p>
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
                2. Data Dokter -> digunakan untuk...</li>
                             
                </ul>

            </div><!-- /.box-body -->
            <div style="display: block;" class="box-footer">
              nb : admin email => admin@gmail.com
            </div><!-- /.box-footer-->
    </div>

    
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"> Isilah Biodata Diri Anda :</h3>
              
            </div>
              <div style="display: block;" class="box-body">
               
               <div class="form-group" align="left">
                <label class="col-md-2 control-label">Nomor Handphone</label>
                 <div class="col-md-4">                  
                    <input type="text" class="form-control" name="no_hp" value="" placeholder="Masukkan Nomor HP">
                    <small class="help-block"></small>
                 </div>
               
                <label class="col-md-2 control-label">Nomor Handphone</label>
                 <div class="col-md-4">                  
                    <input type="text" class="form-control" name="no_hp" value="" placeholder="Masukkan Nomor HP">
                    <small class="help-block"></small>
                 </div>
               </div>  

               <div class="form-group" align="left">
                <label class="col-md-2 control-label">Nomor Polisi</label>
                 <div class="col-md-4">                  
                    <input type="text" class="form-control" name="no_hp" value="" placeholder="Masukkan Nomor HP">
                    <small class="help-block"></small>
                 </div>
               
                <label class="col-md-2 control-label">Nomor Mobil</label>
                 <div class="col-md-4">                  
                    <input type="text" class="form-control" name="no_hp" value="" placeholder="Masukkan Nomor HP">
                    <small class="help-block"></small>
                 </div>
               </div>                  

              </div><!-- /.box-body -->
            <div style="display: block;" class="box-footer">
              nb : admin email => admin@gmail.com
            </div><!-- /.box-footer-->
    </div>

<section id="download">
  <h2 class="page-header"><a href="#download">Download</a></h2>
  <p class="lead">
    AdminLTE can be downloaded in two different versions, each appealing to different skill levels and use case.
  </p>
  <div class="row">
    <div class="col-sm-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ready</h3>
          <span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
          <p>Compiled and ready to use in production. Download this version if you don't want to customize AdminLTE's LESS files.</p>
          <a href="http://almsaeedstudio.com/download/AdminLTE-dist" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-sm-6">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Source Code</h3>
          <span class="label label-danger pull-right"><i class="fa fa-database"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
          <p>All files including the compiled CSS. Download this version if you plan on customizing the template. <b>Requires a LESS compiler.</b></p>
          <a href="http://almsaeedstudio.com/download/AdminLTE" class="btn btn-danger"><i class="fa fa-download"></i> Download</a>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  <pre class="hierarchy bring-up"><code class="language-bash" data-lang="bash">File Hierarchy of the Source Code Package

AdminLTE/
├── dist/
│   ├── CSS/
│   ├── JS
│   ├── img
├── build/
│   ├── less/
│   │   ├── AdminLTE's Less files
│   └── Bootstrap-less/ (Only for reference. No modifications have been made)
│       ├── mixins/
│       ├── variables.less
│       ├── mixins.less
└── plugins/
    ├── All the customized plugins CSS and JS files</code></pre>
</section>    

<section id="app-component">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <!-- Apply any bg-* class to to the info-box to color it -->
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Likes</span>
            <span class="info-box-number">41,410</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: 50%"></div>
            </div>
            <span class="progress-description">
              50% up in 2015
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div>
      
      <div class="col-md-3">        
        <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">250,481</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% up in 2016
                  </span>
                </div><!-- /.info-box-content -->
              </div>
      </div>  

      <div class="col-md-3">        
        <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">400,776</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 80%"></div>
                  </div>
                  <span class="progress-description">
                    80% up in 2017
                  </span>
                </div><!-- /.info-box-content -->
              </div>
      </div> 

      <div class="col-md-3">        
        <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">500,381</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 90%"></div>
                  </div>
                  <span class="progress-description">
                    90% up in 2018
                  </span>
                </div><!-- /.info-box-content -->
              </div>
      </div> 

</section>    

<!-- <h1 style="font-size:60px; color:red; text-align:left;">Heading 1</h1> -->

<section id="introduction">

  <h2 class="page-header"><a href="#introduction">Introduction</a></h2>
  <p class="lead">
    <b>AdminLTE</b> is a popular open source WebApp template for admin dashboards and control panels.
    It is a responsive HTML template that is based on the CSS framework Bootstrap 3.
    It utilizes all of the Bootstrap components in its design and re-styles many
    commonly used plugins to create a consistent design that can be used as a user
    interface for backend applications. AdminLTE is based on a modular design, which
    allows it to be easily customized and built upon. This documentation will guide you through
    installing the template and exploring the various components that are bundled with the template.
  </p>
</section>

     


             
@endsection
@section('script')



@endsection