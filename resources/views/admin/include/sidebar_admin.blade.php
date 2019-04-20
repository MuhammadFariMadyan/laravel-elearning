      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('/img/avatar04.png')}}" class="img-circle" alt="User Image" />
                </div>
            <div class="pull-left info">
              <p>Admin</p>
              <a ><i class="fa fa-circle text-success"></i> {{ Auth::user()->name }}</a>
            </div>
          </div>

          <!-- Sidebar Menu Header-->
        <ul class="sidebar-menu">
            <li class="header" style=" text-align: center;"> <font color = "white";"><b>MAIN NAVIGATION ADMIN </b> </font> </li>
            <!-- Optionally, you can add icons to the links -->
            <li class="@if(url('/') == request()->url()) active @else '' @endif"><a href="{{ url('/') }}">
              <i class='fa fa-dashcube'></i> <span>Dashboard </span></a>
            </li>

            <!-- Menu Admin-->
            <!-- Pilihan, untuk menampilkan menu yang dapat digunakan oleh 3 jenis pengguna, yaitu admin, guru, dan siswa -->
           <li class="@if(url('admin/user') == request()->url() or url('admin/tambahuser') == request()->url() or url('admin/user/1/edit') == request()->url() or url('admin/user/2/edit') == request()->url() or url('admin/user/3/edit') == request()->url() or url('admin/user/4/edit') == request()->url() or url('admin/user/5/edit') == request()->url() ) active @else '' @endif"><a href="{{ url('admin/user') }}">
            <i class='fa fa-user'></i> <span>Kelola Pengguna</span></a>
           </li>  

           <li class="@if(url('admin/kelas') == request()->url() or url('admin/tambahkelas') == request()->url() or url('admin/kelas/1/edit') == request()->url() or url('admin/kelas/2/edit') == request()->url() or url('admin/kelas/3/edit') == request()->url() or url('admin/kelas/4/edit') == request()->url() or url('admin/kelas/5/edit') == request()->url() ) active @else '' @endif"><a href="{{ url('admin/kelas') }}">
            <i class='fa fa-home'></i> <span>Kelola Kelas</span></a>
           </li>         
                                                                                       
           <li class="@if(url('admin/pengumuman') == request()->url() or url('admin/tambahpengumuman') == request()->url() or url('admin/pengumuman/1/edit') == request()->url() or url('admin/pengumuman/2/edit') == request()->url() or url('admin/pengumuman/3/edit') == request()->url() or url('admin/pengumuman/4/edit') == request()->url() or url('admin/pengumuman/5/edit') == request()->url() ) active @else '' @endif"><a href="{{ url('admin/pengumuman') }}">
            <i class='fa fa-bullhorn'></i> <span>Kelola Pengumuman</span></a>
           </li>

           <li class="@if(url('admin/siswa') == request()->url() or url('admin/tambahsiswa') == request()->url() or url('admin/siswa/1/edit') == request()->url() or url('admin/siswa/2/edit') == request()->url() or url('admin/siswa/3/edit') == request()->url() or url('admin/siswa/4/edit') == request()->url() or url('admin/siswa/5/edit') == request()->url() ) active @else '' @endif"><a href="{{ url('admin/siswa') }}">
            <i class='fa fa-users'></i> <span>Kelola Siswa</span></a>
           </li>

           <li class="@if(url('admin/guru')  == request()->url() or url('admin/tambahguru')  == request()->url() ) active @else '' @endif"><a href="{{ url('admin/guru') }}">
            <i class='fa fa-user-plus'></i> <span>Kelola Guru</span></a>
           </li>                                 

            <li class="@if(url('admin/mapel') == request()->url() or url('admin/materi_ajar') == request()->url() or url('admin/tugas') == request()->url() or url('admin/message/send') == request()->url() or url('admin/ujian') == request()->url() or url('admin/nilai') == request()->url() or url('admin/nilai_tugas')  == request()->url() or url('admin/nilai_ujian')  == request()->url() or url('admin/tambahmapel')  == request()->url()or url('admin/tambahmateri_ajar')  == request()->url() or url('admin/tambahtugas')  == request()->url() or url('admin/tambahujian')  == request()->url() or url('admin/tambahnilai') == request()->url() or url('admin/tambahnilai_tugas')  == request()->url() or url('admin/tambahnilai_ujian')  == request()->url() or url('admin/soal_ujian') == request()->url() or url('admin/tambah_soal_ujian')  == request()->url() or url('admin/nilai_siswa') == request()->url()) treeview active @else '' @endif">
              <a href="">
                <i class="fa fa-list-alt"></i>
                <span>Kelola Mata Pelajaran</span>
                <span class="label label-primary pull-right">6</span>
              </a>
              <ul class="treeview-menu">    
                <li class="@if(url('admin/mapel') == request()->url() or url('admin/tambahmapel')  == request()->url() ) active @else '' @endif">
                  <a href="{{{URL::to('admin/mapel')}}}"><i class="fa fa-plus-square">                    
                  </i> Kelola Mata Pelajaran</a>
                </li>

                <li class="@if(url('admin/materi_ajar') == request()->url() or url('admin/tambahmateri_ajar')  == request()->url() ) active @else '' @endif">
                  <a href="{{{URL::to('admin/materi_ajar')}}}"><i class="fa fa-plus-square">                    
                  </i> Kelola Materi Ajar</a>
                </li>                
                
                <li class="@if(url('admin/tugas') == request()->url() or url('admin/tambahtugas')  == request()->url() or url('admin/message/send') == request()->url()) active @else '' @endif">
                  <a href="{{{URL::to('admin/tugas')}}}"><i class="fa fa-plus-square">                    
                  </i> Kelola Tugas</a>
                </li>

                <li class="@if(url('admin/ujian') == request()->url() or url('admin/tambahujian')  == request()->url() ) active @else '' @endif">
                  <a href="{{{URL::to('admin/ujian')}}}"><i class="fa fa-plus-square">                    
                  </i> Kelola Ujian</a>
                </li>

                <li class="@if(url('admin/soal_ujian') == request()->url() or url('admin/tambah_soal_ujian')  == request()->url() ) active @else '' @endif">
                  <a href="{{{URL::to('admin/soal_ujian')}}}"><i class="fa fa-plus-square">                    
                  </i> Kelola Soal Ujian</a>
                </li>
                
                  
                  <li class="@if(url('admin/nilai_siswa') == request()->url() ) active @else '' @endif">
                      <a href="{{{URL::to('admin/nilai_siswa')}}}"><i class="fa fa-plus-square">                    
                      </i>Nilai Siswa</a>
                    </li>                 
                  
                  </ul>
                </li>

              </ul>
            </li>

          <!--  <li class="@if(url('admin/test_view') == request()->url()) active @else '' @endif"><a href="{{ url('admin/test_view') }}">
            <i class='fa fa-user-plus'></i> <span>View New</span></a>
           </li>  -->

        </ul><!-- /.sidebar-menu -->        
        </section>
        <!-- /.sidebar -->
      </aside>
