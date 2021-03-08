<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list d-none d-md-inline-block">
            <a href="#" id="btn-fullscreen" class="nav-link waves-effect waves-light">
                <i class="mdi mdi-crop-free noti-icon"></i>
            </a>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{asset('admin')}}/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>
                <!-- item-->
                <a href="{{ route("password_change") }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-face-profile"></i>
                    <span>Reset Profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <!-- item-->
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                    <i class="mdi mdi-power-settings"></i>
                    <span>Logout</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>

            </div>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">
            <a href="{{url('/')}}" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="{{asset('admin')}}/images/logo.png" alt="">
                    <!-- <span class="logo-lg-text-dark">Moltran</span> -->
                </span>
                <span class="logo-sm">
                    <!-- <span class="logo-lg-text-dark">M</span> -->
                    <img src="{{asset('admin')}}/images/logo.png" alt="">
                </span>
            </a>

            <a href="{{url('/')}}" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="{{asset('admin')}}/images/logo.png" alt="">
                    <!-- <span class="logo-lg-text-dark">Moltran</span> -->
                </span>
                <span class="logo-sm">
                    <!-- <span class="logo-lg-text-dark">M</span> -->
                    <img src="{{asset('admin')}}/images/logo-sm.png" alt="">
                </span>
            </a>
        </div>

    <!-- LOGO -->


    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>
    </ul>
</div>