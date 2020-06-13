<?php $r = \Route::current()->getAction() ?>
<?php $route = (isset($r['as'])) ? $r['as'] : ''; ?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Bloo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin')}}" class="nav-link <?php echo (  Str::startsWith($route, 'admin') ) ? "active" : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('operation.index')}}" class="nav-link <?php echo (  Str::startsWith($route, 'operation') ) ? "active" : '' ?>">
                        <i class="nav-icon fas fa-poll-h"></i>
                        <p>Opérations</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link <?php echo (  Str::startsWith($route, 'sondage') ) ? "active" : '' ?>">
                        <i class="nav-icon fas fa-poll-h"></i>
                        <p>Sondages</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link <?php echo (  Str::startsWith($route, 'user') ) ? "active" : '' ?>">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link <?php echo (  Str::startsWith($route, 'messages') ) ? "active" : '' ?>">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>Messages</p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
