<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-text ">Blog Sitesi Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item ">
            <a class="nav-link" href="{{url('/admin/coins')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Coin Yönetimi
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link  @if(Request::segment(2)=='coins') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-edit"></i>
                <span>Coinler</span>
            </a>
            <div id="collapseTwo" class="collapse  @if(Request::segment(2)=='coins') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Coin İşlemleri:</h6>
                    <a class="collapse-item @if(Request::segment(2)=='coins' and !Request::segment(3)) active @endif" href="{{url('/admin/coins')}}">Tüm Coinler</a>
                    <a class="collapse-item @if(Request::segment(2)=='coins' and Request::segment(3)=='create') active @endif" href="{{url('/admin/coins/create')}}">Coin Oluştur</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link  @if(Request::segment(2)=='categories') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-edit"></i>
                <span>Kategoriler</span>
            </a>
            <div id="collapseTwo" class="collapse  @if(Request::segment(2)=='categories') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kategori İşlemleri:</h6>
                    <a class="collapse-item @if(Request::segment(2)=='categories' and !Request::segment(3)) active @endif" href="{{url('/admin/categories')}}">Tüm Kategoriler</a>
                    <a class="collapse-item @if(Request::segment(2)=='categories' and Request::segment(3)=='create') active @endif" href="{{url('/admin/categories/create')}}">Kategori Oluştur</a>
                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link  @if(Request::segment(2)=='articles') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-edit"></i>
                <span>Makaleler</span>
            </a>
            <div id="collapseTwo" class="collapse  @if(Request::segment(2)=='articles') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Makale İşlemleri:</h6>
                    <a class="collapse-item @if(Request::segment(2)=='articles' and !Request::segment(3)) active @endif" href="{{url('/admin/articles')}}">Tüm Makaleler</a>
                    <a class="collapse-item @if(Request::segment(2)=='articles' and Request::segment(3)=='create') active @endif" href="{{url('/admin/articles/create')}}">Makale Oluştur</a>
                </div>
            </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fas fa-user"></i></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    <a href="{{url('/')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-globe fa-sm text-white-50"></i> Siteyi Görüntüle</a>
                </div>

                <!-- Content Row -->
