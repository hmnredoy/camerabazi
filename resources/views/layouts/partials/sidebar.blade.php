<!-- Brand Logo -->
<a href="{{ url('dashboard') }}" class="brand-link">
    {{--    <img src="{{ asset("img/AdminLTELogo.png") }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
    <div class="text-center">
        <span class="brand-text font-weight-light">Pragati</span>
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
                <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('operation.index') }}" class="nav-link {{ Route::is('operation.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Operations</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('notice.index') }}" class="nav-link {{ Route::is('notice.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Notices</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('tmr.index') }}" class="nav-link {{ Route::is('tmr.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>TMRs</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('tmr-route.index') }}" class="nav-link {{ Route::is('tmr-route.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>TMR Routes</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('branch.index') }}" class="nav-link {{ Route::is('branch.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Branches</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('brand.index') }}" class="nav-link {{ Route::is('brand.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Brands</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('distribution-point.index') }}" class="nav-link {{ Route::is('distribution-point.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Distribution Points</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('outlet.index') }}" class="nav-link {{ Route::is('outlet.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Outlets</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('outlet-slab.index') }}" class="nav-link {{ Route::is('outlet-slab.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Outlet Slabs</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('outlet-target.index') }}" class="nav-link {{ Route::is('outlet-target.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Outlet Targets</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('outlet-type.index') }}" class="nav-link {{ Route::is('outlet-type.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Outlet Type</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('outlet-classification.index') }}" class="nav-link {{ Route::is('outlet-classification.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Outlet Classification</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Products</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('product-category.index') }}" class="nav-link {{ Route::is('product-category.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Product Categories</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('route.index') }}" class="nav-link {{ Route::is('route.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Routs</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('shelf-size.index') }}" class="nav-link {{ Route::is('shelf-size.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Shelf Sizes</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('question.index') }}" class="nav-link {{ Route::is('question.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Questions</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('survey.index') }}" class="nav-link {{ Route::is('survey.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Surveys</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('survey_report.index') }}" class="nav-link {{ Route::is('survey_report.*')?'active':'' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Survey Reports</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
