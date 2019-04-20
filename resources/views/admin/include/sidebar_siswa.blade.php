<!-- Terpaksa Ngoding di View -->
<?php 
  $i = Auth::user()->level;
  $idUser = Auth::user()->id_user;                         
  $siswa = \App\Siswa::where('id_user', $idUser)->first(); // detail field siswa yang sedang login.
  $guru = \App\Guru::where('id_user', $idUser)->first(); // detail field siswa yang sedang login.
?>      
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel --> <!-- $dataSiswa->foto_siswa -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{URL::to('upload_gambar/'.$siswa->foto_siswa) }}" class="img-circle" alt="User Image" style="height:45px; width:45px;">
                </div>
            <div class="pull-left info">
              <p>Siswa</p>
              <a ><i class="fa fa-circle text-success"></i> {{ Auth::user()->username }}</a>
            </div>
          </div>

          <!-- Sidebar Menu Header-->
        <ul class="sidebar-menu">
            <li class="header" style=" text-align: center;"> <font color = "white";"><b>MAIN NAVIGATION SISWA </b> </font> </li>
            <!-- Optionally, you can add icons to the links -->
            <li class="@if(url('/') == request()->url()) active @else '' @endif"><a href="{{ url('/') }}">
              <i class='fa fa-dashcube'></i> <span>Dashboard</span></a>
            </li>

            <!-- Menu Siswa-->
            <!-- Untuk menampilkan menu yang dapat digunakan oleh siswa -->
            <li class="@if(url('siswa/pengumuman') == request()->url() or url('siswa/tambahpengumuman') == request()->url() or url('siswa/pengumuman/1/edit') == request()->url() or url('siswa/pengumuman/2/edit') == request()->url() or url('siswa/pengumuman/3/edit') == request()->url() or url('siswa/pengumuman/4/edit') == request()->url() or url('siswa/pengumuman/5/edit') == request()->url() ) active @else '' @endif"><a href="{{ url('siswa/pengumuman') }}">
            <i class='fa fa-bullhorn'></i> <span> Pengumuman</span></a>
           </li>

            <li class="@if(url('siswa/kelas_siswa') == request()->url() or url('siswa/tambahmateri_ajar')  == request()->url() ) active @else '' @endif">
              <a href="{{{URL::to('siswa/kelas_siswa')}}}"><i class="fa fa-home">                    
              </i> Kelas Anda </a>
            </li> 

            <li class="@if(url('siswa/materi_ajar') == request()->url() or url('siswa/tambahmateri_ajar')  == request()->url() ) active @else '' @endif">
              <a href="{{{URL::to('siswa/materi_ajar')}}}"><i class="fa fa-list-ol">                    
              </i> Materi Mata Pelajaran</a>
            </li>                             
                
            <li class="@if(url('siswa/tugas') == request()->url() or url('siswa/tambahtugas')  == request()->url() or url('siswa/message/send') == request()->url()) active @else '' @endif">
              <a href="{{{URL::to('siswa/tugas')}}}"><i class="fa fa-tasks">                    
              </i> Tugas</a>
            </li>

            <li class="@if(url('siswa/ujian') == request()->url() or url('siswa/tambahujian')  == request()->url() ) active @else '' @endif">
              <a href="{{{URL::to('siswa/ujian')}}}"><i class="fa fa-edit">                    
              </i> Ujian</a>
            </li>

            <li class="@if(url('siswa/nilai') == request()->url() or url('siswa/nilai') == request()->url() ) active @else '' @endif">
              <a href="{{{URL::to('siswa/nilai')}}}"><i class="fa  fa-check-square-o">                    
              </i>Nilai </a>
            </li>

        </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
