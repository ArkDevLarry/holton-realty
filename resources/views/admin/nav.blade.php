<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <a class="navbar-brand" href="index.html">{{ config("app.name") }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item">
                    <div id="custom-search" class="top-search-bar">
                        <input class="form-control" type="text" placeholder="Search..">
                    </div>
                </li>
                <li class="nav-item dropdown notification">
                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                        <li>
                            <div class="notification-title"> Notification</div>
                            <div class="notification-list">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action active">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img src="assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy Rakestraw</span>accepted your invitation to join the team.
                                                <div class="notification-date">2 min ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="list-footer"> <a href="#">View all notifications</a></div>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name">{{ ucfirst(Auth::user()->username) }} </h5>
                            <small class="">{{ Auth::user()->email }}</small>
                        </div>
                        <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- ============================================================== -->
<!-- end navbar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link{{ Route::currentRouteName() == "dashboard" ? " active" : ""}}" href="{{ route('dashboard') }}"><i class="fa fa-fw fa-user-circle"></i>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-rocket"></i>Admins</a>
                        <div id="submenu-1" class="collapse submenu {{ in_array(Route::currentRouteName(), ["create-admin", "manage-admin"]) ? " show" : ""}}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ Route::currentRouteName() == "create-admin" ? " active" : ""}}" href="{{ route('admin.create') }}">Create Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ Route::currentRouteName() == "manage-admin" ? " active" : ""}}" href="{{ route('admin.index') }}">Manage Admin</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Property</a>
                        <div id="submenu-2" class="collapse submenu {{ in_array(Route::currentRouteName(), ["create-property", "manage-property"]) ? " show" : ""}}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ Route::currentRouteName() == "create-property" ? " active" : ""}}" href="{{ route('create-property') }}">Create property</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ Route::currentRouteName() == "manage-property" ? " active" : ""}}" href="{{ route('manage-property') }}">Manage property</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fa fa-fw fa-rocket"></i>Shortlet</a>
                        <div id="submenu-3" class="collapse submenu {{ in_array(Route::currentRouteName(), ["create-shortlet", "manage-shortlet"]) ? " show" : ""}}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ Route::currentRouteName() == "create-shortlet" ? " active" : ""}}" href="{{ route('create-shortlet') }}">Create shortlet</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ Route::currentRouteName() == "manage-shortlet" ? " active" : ""}}" href="{{ route('manage-shortlet') }}">Manage shortlet</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->