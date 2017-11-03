<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION
            </li>
            <li class="treeview">
                <a href="{{ url('/home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if( Auth::user()->admin)
            <li class="treeview">
                <a href="{{ url('/users') }}">
                    <i class="ion ion-person"></i> <span>User Management</span>
                </a>
            </li>
            @endif
            <li class="treeview">
                <a href="{{ url('/sales') }}"><i class="ion ion-bag"></i>Credit Application</a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>