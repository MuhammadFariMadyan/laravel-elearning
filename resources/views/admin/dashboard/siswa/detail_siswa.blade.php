@extends('admin.layout.master')
@section('breadcrump')          
        <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>
          <h1> Detail Siswa         
        <?php endif ?>   
        <?php if (Auth::user()->level  == 13): ?>
          <h1> Biodata Diri Siswa 
        <?php endif ?>
          <small>Control panel</small> </h1> 
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
            <li class="active">Detail Siswa</li>
          </ol>
@stop
@section('content')          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">  
                  <div class="pull-left">
                    <?php if ( Auth::user()->level  == 11 or  Auth::user()->level  == 12): ?>                
                      <strong> Biodata Diri </strong> {{$nama_siswa}}
                    <?php endif ?>   
                    <?php if (Auth::user()->level  == 13): ?>                
                       <strong> Biodata Diri  </strong> {{$nama_siswa}}
                    <?php endif ?> 
                  </div>
                  <div class="pull-right"> 
                    <?php if (Auth::user()->id_user  == $id_user): ?> 
                    <a href="{{ URL::to('siswa/siswa/edit') }}"
                       class="btn btn-primary btn-xs">
                        <span class="fa fa-gear"></span> Ubah Profile
                    </a>
                    <a href="{{ URL::to('siswa/siswa/ubahpassword') }}"
                       class="btn btn-success btn-xs">
                        <span class="fa fa-gear"></span> Ubah Password
                    </a>
                    <?php endif ?>   
                  </div>
                </div><!-- /.box-header -->
                            
                <div class="box-body">
                  <div class="row">
                    <br>
                    <div class="col-md-12" style="margin-left: -2%">
                    <div class="col-md-3">
                      <p align="center">
                        <img src="{{URL::to('upload_gambar/'.$foto_siswa) }}" alt="" style="width:220px; height:260px">
                        <a class="users-list-name" href="#">{{$nama_siswa}}</a>
                        <span class="users-list-date">Status Siswa : {{$status_siswa}}</span>
                      </p>
                    </div><!-- /.col -->
                    <div class="col-md-9" align="left" >
                     <table id="dataSiswa" class="table table-bordered table-hover">                    
                      <tbody>
                        <tr>
                          <td width="20%">NISN</td>  
                          <td>{{$nisn_siswa}}</td>                          
                        </tr>
                        <tr>
                          <td>Nama</td> 
                          <td>{{$nama_siswa}}</td>
                        </tr>
                        <tr>
                          <td>Jenis Kelamin</td> 
                          <td>{{$jns_kelamin_siswa}}</td>
                        </tr>                        
                        <tr>
                          <td>E-Mail</td>
                          <td>{{$email_siswa }}</td>
                        </tr>
                        <tr>
                          <td>Kelas</td> 
                          <td>{{$kelas_siswa}}</td>                        
                        </tr>
                        <tr>
                          <td>Nomor HP</td> 
                          <td>{{$no_hp_siswa}}</td> 
                        </tr> 
                        <tr>
                          <td>Tempat Tanggal Lahir</td> 
                          <td>{{$ttl_siswa}}</td> 
                        </tr> 
                                                                     
                      </tbody>                      
                    </table>
                    </div><!-- /.col -->
                  </div><!-- /.col md-12 -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
                 
              </div>
            </div>
                       
          </div><!-- /.row -->

@endsection
@section('script')

  

@endsection

