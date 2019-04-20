      <header class="main-header">

        <!-- Logo -->
        <a href="{{URL::to('/')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ELN</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>E-Learning</b></span>
        </a>
        <!-- Terpaksa Ngoding di View -->
          <?php 
              $levelSiswa = Auth::user()->level;
              $idUserSiswa = Auth::user()->id_user;                         
              $siswa = \App\Siswa::where('id_user', $idUserSiswa)->first(); // detail field siswa yang sedang login.
              // dd($siswa->foto_siswa);              
           ?>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation </span>
          </a>
          <!-- Navbar Right Menu Selamat Datang di Sistem Informasi E-Learning pada SMP PGRI 1 Bandar Lampung -->
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" >                          

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{URL::to('upload_gambar/'.$siswa->foto_siswa) }}" class="user-image" alt="User Image">
                  <!-- <img src="{{URL::to('upload_gambar/foto .jpg') }}" class="user-image" alt="User Image"> -->
                  <span class="hidden-xs"><b>
                    @if ($levelSiswa === 11)                        
                        Admin                                                    
                    @elseif ($levelSiswa === 12)
                        Guru
                    @else
                        {{ Auth::user()->name }} 
                    @endif
                  </b></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">                    
                    <img src="{{URL::to('upload_gambar/'.$siswa->foto_siswa) }}" class="user-image" alt="User Image">
                    <!-- <img src="{{URL::to('upload_gambar/foto .jpg') }}" class="user-image" alt="User Image" style="margin-left: 40%;"> -->
                    <p>
                      {{ Auth::user()->username  }}<br>
                      <b>Otoritas user : </b>Level {{Auth::user()->level}} 
                      <small></small>
                    </p>
                  </li>                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{{ URL::to('siswa/siswa/'.$siswa->nisn_siswa.'/detail') }}}" class="btn btn-default btn-flat">Profile</a>
                      <!-- <a href="#" class="btn btn-default btn-flat">Profile</a>                       -->
                    </div>
                    <div class="pull-right">
                      <a href="{{{URL::to('/logout')}}}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->              
            </ul>
          </div>

        </nav>
      </header>