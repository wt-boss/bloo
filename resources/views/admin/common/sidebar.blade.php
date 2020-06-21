<?php $r = \Route::current()->getAction() ?>
<?php $route = (isset($r['as'])) ? $r['as'] : ''; ?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i><b>{{ auth()->user()->rolename() }}</b></a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li  class="<?php echo (  Str::startsWith($route, 'admin') ) ? "active" : '' ?>">
                <a href="{{route('admin')}}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php echo (  Str::startsWith($route, 'operation') ) ? "active" : '' ?>">
                <a href="{{route('operation.index')}}" >
                    <i class="nav-icon fas fa-poll-h"></i>
                    <span>Opérations</span>
                </a>
            </li>
            <li class=" <?php echo (  Str::startsWith($route, 'sondage') ) ? "active" : '' ?>">
                <a href="{{route('users.index')}}" >
                    <i class="nav-icon fas fa-poll-h"></i>
                    <span>Sondages</span>
                </a>
            </li>
            <li class="<?php echo (  Str::startsWith($route, 'user') ) ? "active" : '' ?>">
                <a href="{{route('users.index')}}" >
                    <i class="nav-icon fas fa-users-cog"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-link <?php echo (  Str::startsWith($route, 'messages') ) ? "active" : '' ?>">
                <a href="{{route('users.index')}}" >
                    <i class="nav-icon fas fa-comment-alt"></i>
                    <span>Messages</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
