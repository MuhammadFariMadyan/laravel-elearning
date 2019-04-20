@extends('admin.layout.master')
@section('breadcrump')                     
        <?php if (Auth::user()->level  == 13): ?>
          <h1> Kelas anda "{{ $kelas_siswa }}" <small>Control panel</small> </h1> 
        <?php endif ?>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>                                  

          <?php if (Auth::user()->level  == 13): ?>
            <li class="active">Siswa</li> 
            <li class="active">Kelas anda "{{ $kelas_siswa }}"</li>
          <?php endif ?>
          </ol>
@stop
@section('content')                  
          <div class="row">                
            <div class="col-xs-12">
              <div class="box box-danger">
              <div class="box-header with-border" >                              
                <?php if (Auth::user()->level  == 13): ?>                           
                    <class="box-title"><strong> Daftar Mata Pelajaran </strong>
                <?php endif ?>                              
               </div><!-- /.box-header -->                 
                <div class="box-body">                  
                  <table id="dataTabelMataPelajaran" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th style="text-align: left; width: 5%;">No</th>                                                                
                        <th style="text-align: center; width: 95%;">Mata Pelajaran</th>  
                      </tr>
                    </thead>
                    <tbody >
                     <?php $i=1; foreach ($kelas as $dataKelas):  ?>
                      <tr>
                        <td style="text-align: left;">{{$i}}</td>                      
                        <td style="text-align: center;">{{$dataKelas->nama_mapel}}</td>                                                                               
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box box-danger">
              <div class="box-header with-border" >                              
                <?php if (Auth::user()->level  == 13): ?>                           
                    <class="box-title"><strong> Daftar Siswa </strong>
                <?php endif ?>                              
               </div><!-- /.box-header -->                 
                <div class="box-body">                  
                  <table id="dataTabelSiswa" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>No</th>                                         
                        <th>NISN</th>                                               
                        <th>Nama</th>                        
                        <th>Email</th>
                        <th>No. Hp</th>
                        <th>TTL</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>                         
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach ($siswa as $dataSiswa):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dataSiswa->nisn_siswa}}</td>
                        <td>{{$dataSiswa->nama_siswa}}</td>                        
                        <td>{{$dataSiswa->email_siswa}}</td>
                        <td>{{$dataSiswa->no_hp_siswa}}</td>
                        <td>{{$dataSiswa->ttl_siswa}}</td>
                        <td>{{$dataSiswa->jns_kelamin_siswa}}</td>
                        <td>{{$dataSiswa->alamat_siswa}}</td>                                               
                        <td>                         
                          <a href="{{{ URL::to('siswa/siswa/'.$dataSiswa->nisn_siswa.'/detail') }}}">
                              <span class="label label-info"><i class="fa fa-list"> Detail </i></span>
                          </a> 
                        </td>                              
                      </tr>
                      <?php $i++; endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>                                         
                        <th>NISN</th>                                               
                        <th>Nama</th>                        
                        <th>Email</th>
                        <th>No. Hp</th>
                        <th>TTL</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>                         
                        <th>Aksi</th>                        
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
       

@endsection
@section('script')

<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
      $(function () {

        $('#dataTabelSiswa').DataTable({"pageLength": 10}); //, "scrollX": true
        $('#dataTabelMataPelajaran').DataTable({"pageLength": 10}); //, "scrollX": true

      });

    </script>

@endsection

