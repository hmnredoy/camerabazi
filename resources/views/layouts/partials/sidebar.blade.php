<!-- Brand Logo -->
<a href="{{ url('dashboard') }}" class="brand-link">
    {{--    <img src="{{ asset("img/AdminLTELogo.png") }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
    <div class="text-center">
        <span class="brand-text font-weight-light">Camerabaji</span>
    </div>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
{{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
    </div>
</div>--}}

<!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
                <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('location.index') }}" class="nav-link {{ Route::is('location.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Locations</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('skill_tool.index') }}" class="nav-link {{ Route::is('skill_tool.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Skills & Tools</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('membership-plan.index') }}" class="nav-link {{ Route::is('membership-plan.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Membership Plans</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('job.index') }}" class="nav-link {{ Route::is('job.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Jobs</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('bid.index') }}" class="nav-link {{ Route::is('bid.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Bids</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
