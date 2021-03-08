<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="user-box">

                <div class="float-left">
                    <img src="{{asset('admin')}}/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
                </div>
                <div class="user-info">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i>
                                        </a>
                        <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <li><a href="{{ route("password_change") }}" class="dropdown-item"><i class="mdi mdi-face-profile mr-2"></i>Reset Profile<div class="ripple-wrapper"></div></a></li>
                            <li><a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-power-settings mr-2"></i> Logout</a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </ul>
                    </div>
                    <p class="font-13 text-muted m-0">{{ auth()->user()->role->name }}</p>
                </div>
            </div>

            <ul class="metismenu" id="side-menu">

                <li class="mm-<?php echo set_Topmenu("administrator"); ?>">
                    <a href="{{ route("dashboard")}}" class="waves-effect <?php echo set_Topmenu("administrator"); ?>">
                        <i class="mdi mdi-home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                @if (hasActive("course") && hasPermission("course",VIEW))
                <li class="mm-<?php echo set_Topmenu("course"); ?>">
                    <a href="{{ route("admin.course")}}" class="waves-effect <?php echo set_Topmenu("course"); ?>">
                        <i class="mdi mdi-pencil-box-multiple-outline"></i>
                        <span> Course </span>
                    </a>
                </li>
                @endif    @if (hasActive("course_complete_report") && hasPermission("course_complete_report",VIEW))
                <li class="mm-<?php echo set_Topmenu("course_complete_report"); ?>">
                    <a href="{{ route("admin.courseComplete")}}" class="waves-effect <?php echo set_Topmenu("course_complete_report"); ?>">
                        <i class="mdi mdi-pencil-box-multiple-outline"></i>
                        <span> Course Complete Status </span>
                    </a>
                </li>
                @endif
                @if (hasActive("course_module") && hasPermission("course_module",VIEW))
                <li class="mm-<?php echo set_Topmenu("course_module"); ?>">
                    <a href="{{ route("admin.courseModule")}}" class="waves-effect <?php echo set_Topmenu("course_module"); ?>">
                        <i class="mdi mdi-pencil-box-multiple-outline"></i>
                        <span> Course Module </span>
                    </a>
                </li>
                @endif
                @if (hasActive("register_user") && hasPermission("register_user",VIEW))
                <li class="mm-<?php echo set_Topmenu("register_user"); ?>">
                    <a href="{{ route("admin.registerUser")}}" class="waves-effect <?php echo set_Topmenu("register_user"); ?>">
                        <i class="mdi mdi-pencil-box-multiple-outline"></i>
                        <span> Register User </span>
                    </a>
                </li>
                @endif
                @if (hasActive("app_version") && hasPermission("app_version",VIEW))
                <li class="mm-<?php echo set_Topmenu("app_version"); ?>">
                    <a href="{{ route("admin.appVersion")}}" class="waves-effect <?php echo set_Topmenu("app_version"); ?>">
                        <i class="mdi mdi-pencil-box-multiple-outline"></i>
                        <span> App Version </span>
                    </a>
                </li>
                @endif
                @if (hasActive("administrator") && hasPermission("administrator",VIEW))
                    <li class="mm-<?php echo set_Topmenu("administrator"); ?>">
                        <a href="javascript: void(0);" class="waves-effect <?php echo set_Topmenu("administrator"); ?>">
                            <i class="mdi mdi-account-settings-outline"></i>
                            <span> Administrator </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            @if (is_super_admin())
                            <li class="mm-{{set_Submenu("module")}}"><a href="{{url("module")}}">Module</a></li>
                            @endif
                            @if (hasPermission("role_permission",VIEW))
                            <li class="mm-{{set_Submenu("role-permission")}}"><a href="{{route("role")}}">Role Permission</a></li>
                            @endif
                            @if (hasPermission("manage_user",VIEW))
                            <li class="mm-{{set_Submenu("manage-user")}}"><a href="{{route("users")}}">Manage User</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
