@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Pasien</li>
           
          </ol>
@stop
@section('content')
          <h3> Data Pasien di UPT. Puskesmas Talang Padang </h3>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tambah Data Pasien <a href="{{{ URL::to('admin/tambahpasien') }}}" class="btn btn-success btn-flat btn-sm" id="tambahPasien" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                </div><!-- /.box-header  -->
                
                <div class="box-body">
                  <table id="dataTabelPasien" class="table table-bordered table-hover">
                    <thead>
                      <tr> 
                        <th>Kode Pasien</th>                                         
                        <th>Nama Pasien</th>                                               
                        <th>Alamat</th>
                        <th>Rt</th>
                        <th>Rw</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>                          
                        <th>Jenis Pembayaran</th>
                        <th>No Jaminan</th>
                        <th>Pekerjaan</th>
                        <th>Pendidikan Terakhir</th>
                        <th>Telp</th>
                        <th>Ortu/Suami</th>
                        <th>Istri/Anak</th>
                        <th>Alergi Obat</th>
                        
                        <th>Aksi</th>

                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($pasien as $dataPasien):  ?>
                      <tr>
                        <td>{{$dataPasien->kode_pasien}}</td>
                        <td>{{$dataPasien->nama_pasien}}</td>
                        <td>{{$dataPasien->alamat}}</td>
                        <td>{{$dataPasien->rt}}</td>                                               
                        <td>{{$dataPasien->rw}}</td>
                        <td>{{$dataPasien->tgl_lahir}}</td>
                        <td>{{$dataPasien->agama}}</td>
                        <td>{{$dataPasien->Jen_pmbyrn}}</td>
                        <td>{{$dataPasien->no_jaminan}}</td>                                               
                        <td>{{$dataPasien->pekerjaan}}</td>
                        <td>{{$dataPasien->pend_trkhr}}</td>
                        <td>{{$dataPasien->telp}}</td>
                        <td>{{$dataPasien->ortu_suami}}</td>
                        <td>{{$dataPasien->istri_anak}}</td>                                               
                        <td>{{$dataPasien->alergi_obat}}</td>                                              
                        
                        <td>
                          <a href="{{{ URL::to('admin/pasien/'.$dataPasien->kode_pasien.'/edit') }}}">
                              <span class="label label-warning" ><i class="fa fa-edit" >&nbsp;&nbsp; Edit &nbsp;&nbsp;&nbsp;</i></span>
                              </a> 
                          <a href="{{{ action('Admin\PasienController@hapus',[$dataPasien->kode_pasien]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Pasien {{{($dataPasien->kode_pasien).' - '.$dataPasien->nama_pasien }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash">&nbsp;&nbsp; Delete &nbsp;&nbsp;</i></span>
                          </a>
                          <a href="{{{ URL::to('admin/pasien/'.$dataPasien->kode_pasien.'/cetak/233') }}}">
                            <span class="label   label-info"><i class="fa fa-print">&nbsp;&nbsp;Cetak&nbsp;&nbsp;</i></span> 
                           </a>
                        </td>                              
                      </tr>
                      <?php endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Kode Pasien</th>                                         
                        <th>Nama Pasien</th>                                               
                        <th>Alamat</th>
                        <th>Rt</th>
                        <th>Rw</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>                          
                        <th>Jenis Pembayaran</th>
                        <th>No Jaminan</th>
                        <th>Pekerjaan</th>
                        <th>Pendidikan Terakhir</th>
                        <th>Telp</th>
                        <th>Ortu/Suami</th>
                        <th>Istri/Anak</th>
                        <th>Alergi Obat</th>
                        
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

        $('#dataTabelPasien').DataTable({"pageLength": 10, "scrollX": true});

      });

    </script>

@endsection

