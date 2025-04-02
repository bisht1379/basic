<div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
          
            <li class="nav-item dropdown no-arrow">

            <form action="{{ route('admin.logout') }}" method="POST">@csrf
       
       <button type="submit" class="btn btn-secondary" style="background-color: #254260; border-color: #254260; color: white;" >Logout</button>

    </form>


    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <div class="dropdown-divider"></div>

<!--    
        <form action="{{ route('admin.logout') }}" method="POST">@csrf
       
            <button type="submit" class="btn btn-primary" style="margin-left: 40px;">Logout</button>
        </form> -->
    </div>
</li>
          </ul>
        </nav>
        <!-- Topbar -->