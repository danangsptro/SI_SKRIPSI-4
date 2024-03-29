@php
    $role_id = Auth::user()->role_id;
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center bg-white justify-content-center" href="index.html">
        <div class="mx-3">
            <img src="{{ asset('images/logo.jpeg') }}" class="img-fluid" width="90" alt="">
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>
    @if ($role_id == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
        </a>
    </li>
    @endif
    @if ($role_id == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('room.index') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>Room</span>
        </a>
    </li>
    @endif
    @if ($role_id == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('purpose.index') }}">
            <i class="fas fa-fw fa-file-archive"></i>
            <span>Purpose</span>
        </a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('visit.index') }}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Visit</span>
        </a>
    </li>
    @if ($role_id == 1 || $role_id == 2 || $role_id == 4)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Report</span>
        </a>
    </li>
    @endif
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
