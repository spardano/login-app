<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
      <a class="navbar-brand" href="#">Admin Active</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
          </li>

          @role('admin')
          <li class="nav-item">
            <a class="nav-link" href={{ url("/suratnikah") }}>Surat Nikah</a>
          </li>
          @endrole

          @role('admin|adminkelurahan|pejabat')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('suratumum') }}">Surat Umum</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href={{ route('penduduk') }}>Data Penduduk</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('pejabat') }}">Pejabat</a>
          </li>
          @endrole

          @role('admin')
          <li class="nav-item">
            <a class="nav-link" href={{ url('/roles') }}>Roles</a>
          </li>
          @endrole

          @role('admin')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('users') }}">Users</a>
          </li>
          @endrole

          @role('admin|adminkelurahan')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('penomoran_surat') }}">Penomoran Surat</a>
          </li>
          @endrole


          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-primary" href={{ route('logout') }} onclick="event.preventDefault();
              this.closest('form').submit();">Log Out</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>