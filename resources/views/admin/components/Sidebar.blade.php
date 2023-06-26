<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item collapsed">
            <a class="nav-link " href="{{route('admin.dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('departments.index')}}">
                <i class="bi bi-diagram-3"></i>
                <span>Department</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('users.index')}}">
                <i class="bi bi-people"></i>
                <span>Customer</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('staff.index')}}">
                <i class="bi bi-people"></i>
                <span>Staff</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('categories.index')}}">
                <i class="bi bi-diagram-3"></i>
                <span>Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('packages.index')}}">
                <i class="bi bi-tablet-landscape"></i>
                <span>Packages</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('coupons.index')}}">
                <i class="bi bi-tablet-landscape"></i>
                <span>Coupon</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('apointments.index')}}">
                <i class="bi bi-layout-text-window-reverse"> </i>
                <span>Apointments</span>
            </a>
        </li>
        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign out</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside>
