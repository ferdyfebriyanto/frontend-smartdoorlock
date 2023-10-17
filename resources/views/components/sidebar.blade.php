<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Smart Door Lock</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SDL</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>

            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('/') }}"><i class="far fa-square"></i> <span>Dashboard</span></a>
            </li>

            <li class="menu-header">Master</li>

            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('/users') }}"><i class="far fa-user"></i> <span>User</span></a>
            </li>

            <li class="menu-header">Report</li>

            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('/history') }}"><i class="far fa-square"></i> <span>History</span></a>
            </li>
        </ul>
    </aside>
</div>
