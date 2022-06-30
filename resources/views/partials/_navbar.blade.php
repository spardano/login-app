<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

<style>
  .body{
    margin: 10px;
  }

  .icon-button {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    color: #333333;
    background: #dddddd;
    border: none;
    outline: none;
    border-radius: 50%;
  }

  .icon-button__badge {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 24px;
    height: 25px;
    background: red;
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
  }
</style>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100" >
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/logo_Bukittinggi.png" alt="profile"/>
              <span class="nav-profile-name">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="typcn typcn-cog-outline text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          
        </ul>
        <ul class="navbar-nav navbar-nav-right">
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>