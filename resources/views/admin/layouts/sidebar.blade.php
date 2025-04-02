<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}" title="The Ministry of Home Affairs (MHA)">
  <div class="sidebar-brand-icon">
    <img class="national_emblem" src="{{asset('assets/img/logo/logo2.png')}}" alt="The Ministry of Home Affairs" title="The Ministry of Home Affairs" style="width: 55px;max-height: 3.3rem;">
  </div>
  <div class="sidebar-brand-text mx-3">
    <strong>गृह मंत्रालय</strong> Ministry of <span>Home Affairs</span>
  </div>
</a>

      <hr class="sidebar-divider my-0">
      <li class="nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
     
      @php
        $user = Auth::user();
            $role = DB::table('roles')
            ->join('users', 'roles.id', '=', 'users.role_id')
            ->where('users.id', $user->id) 
            ->select('roles.role_name as role_name')
            ->first(); 

      @endphp

      @if ($role && $role->role_name === 'Admin') 
      <li class="nav-item {{ Request::routeIs('role.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('role.index')}}">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Roles</span>
        </a>
      </li>

      <hr class="sidebar-divider">
     @endif

     @if ($role && $role->role_name === 'Admin') 
     <li class="nav-item {{ Request::routeIs('user.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('user.index')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Users</span>
        </a>
      </li>
      <hr class="sidebar-divider">

      @endif
      @if ($role && $role->role_name === 'Admin') 
         <li class="nav-item {{ Request::routeIs('user.reset.password') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('user.reset.password')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Reset Password</span>
        </a>
      </li>
      @endif
    </ul>
    <!-- Sidebar -->