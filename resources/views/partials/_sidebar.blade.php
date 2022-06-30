<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item">   
                <a class="nav-link" href="{{ url('/') }}"><i class="typcn typcn-home menu-icon"></i>Dashboard</a> 
        </li>

        @role('admin|adminkelurahan|pejabat')
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="typcn typcn-document-text menu-icon"></i>
                <span class="menu-title">Pengajuan Surat</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    @role('pejabat')
                    <li class="nav-item"> <a class="nav-link" href="{{ route('Suratkepejabat') }}">Surat Umum</a></li>
                    @endrole
                    @role('admin|adminkelurahan')
                    <li class="nav-item"> <a class="nav-link" href="{{ route('suratumum') }}">Surat Umum</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Surat Lainya</a></li>
                    @endrole
                    
                   
                    <li class="nav-item"> <a class="nav-link" href="{{ url(" /suratnikah ") }}">Surat Nikah</a></li>
                    
                </ul>
            </div>
        </li>
        @endrole 
        
        @role('adminkelurahan')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('penduduk') }}">
                <i class="typcn typcn-group menu-icon"></i>
                <span class="menu-title">Data Penduduk</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('pejabat') }}">
                <i class="typcn typcn-th-large menu-icon"></i>
                <span class="menu-title">Jabatan Penting</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('penomoran_surat') }}">
                <i class=" typcn typcn-th-list menu-icon"></i>
                <span class="menu-title">Penomoran Surat</span>
            </a>
        </li>
        @endrole

        @role('pejabat')
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="ui-basic">
                <i class=" typcn typcn-spanner menu-icon"></i>
                <span class="menu-title">Setting</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setting">
                <ul class="nav flex-column sub-menu">
                    
                    <li class="nav-item"> <a class="nav-link" href="{{route('ttd')}}">signetur TTD</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Profile</a></li>
                </ul>
            </div>
        </li>
        @endrole

        @role('admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('klasifikasi_surat') }}">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Klasifikasi Surat</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('users') }}">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/roles') }}">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Roles</span>
            </a>
        </li>
        @endrole

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href={{ route('logout') }} onclick="event.preventDefault();
                this.closest('form').submit();"><i class="typcn typcn-power-outline menu-icon"></i>Log Out </a>
                 
            </form>

        </li>

        <li class="nav-item">
            
      </li>
        
    </ul>
</nav>