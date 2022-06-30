<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item">
                <a class="nav-item-hold" href="{{ url('/') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('uikits/*') ? 'active' : '' }}" data-item="surat-umum">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">Layanan umum</span>
                </a>
                <div class="triangle"></div>
            </li>
            @role('admin')
            <li class="nav-item {{ request()->is('extrakits/*') ? 'active' : '' }}" data-item="Users">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Suitcase"></i>
                    <span class="nav-text">Users</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endrole

            <li class="nav-item {{ request()->is('apps/*') ? 'active' : '' }}" data-item="struktur">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Computer-Secure"></i>
                    <span class="nav-text">Struktur Organisasi</span>
                </a>
                <div class="triangle"></div>
            </li>
            
            <li class="nav-item {{ request()->is('sessions/*') ? 'active' : '' }}" data-item="sessions">
                <a class="nav-item-hold" href="/test.html">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Setting</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->

        <ul class="childNav" data-parent="struktur">
            
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='invoice' ? 'open' : '' }}" href="{{ route('pejabat') }}">
                    <i class="nav-icon i-Add-File"></i>
                    <span class="item-name">Pejabat Kelurahan</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='invoice' ? 'open' : '' }}" href="{{ route('penduduk') }}">
                    <i class="nav-icon i-Add-File"></i>
                    <span class="item-name">Kependudukan</span>
                </a>
            </li>
        </ul>

        <ul class="childNav" data-parent="Users">    
            @role('admin')
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='imageCroper' ? 'open' : '' }}" href="{{route('imageCroper')}}">
                    <i class="nav-icon i-Crop-2"></i>
                    <span class="item-name">Roles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='dropDown' ? 'open' : '' }}" href="{{ url('users') }}">
                    <i class="nav-icon i-Arrow-Down-in-Circle"></i>
                    <span class="item-name">Data Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='loader' ? 'open' : '' }}" href="{{route('loader')}}">
                    <i class="nav-icon i-Loading-3"></i>
                    <span class="item-name">Users Roles</span>
                </a>
            </li>
            @endrole
        </ul>

        <ul class="childNav" data-parent="surat-umum">
            <li class="nav-item">
                @role('adminkelurahan')
                <a class="{{ Route::currentRouteName()=='alerts' ? 'open' : '' }}" href="{{ route('suratumum') }}">
                    <i class="nav-icon i-Bell1"></i>
                    <span class="item-name">Permintaan surat umum</span>
                </a>
                @endrole

                @role('pejabat')
                <a class="{{ Route::currentRouteName()=='alerts' ? 'open' : '' }}" href="{{ route('Suratkepejabat') }}">
                    <i class="nav-icon i-Bell1"></i>
                    <span class="item-name">Permintaan surat</span>
                </a>
                @endrole
            </li>

            @role('adminkelurahan')
            <li class="nav-item">
                
                <a class="{{ Route::currentRouteName()=='alerts' ? 'open' : '' }}" href="{{ route('suratnikah') }}">
                    <i class="nav-icon i-Bell1"></i>
                    <span class="item-name">Permintaan surat nikah</span>
                </a>
            </li>
            @endrole
            
            @role('adminkelurahan')
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='accordion' ? 'open' : '' }}" href="{{ route('penomoran_surat') }}">
                    <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                    <span class="item-name">Penomoran surat</span>
                </a>
            </li>
            @endrole
        </ul>

        <ul class="childNav" data-parent="sessions">
            @role('pejabat')
            <li class="nav-item">
                <a href="{{route('ttd')}}">
                    <i class="nav-icon i-Checked-User"></i>
                    <span class="item-name">Signature Pejabat</span>
                </a>
            </li>
            @endrole
            <li class="nav-item">
                <a href="{{route('forgot')}}">
                    <i class="nav-icon i-Find-User"></i>
                    <span class="item-name">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->