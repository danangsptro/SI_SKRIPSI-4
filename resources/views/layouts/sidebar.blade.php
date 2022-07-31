<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center bg-white justify-content-center" href="index.html">
        <div class="mx-3">
            <img src="{{ asset('images/logo.png') }}" class="img-fluid" width="100" alt="">
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('room.index') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>Room</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-file-archive"></i>
            <span>Purpose</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-plus"></i>
            <span>Request</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Report</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
