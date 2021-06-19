<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    @if(auth()->user()->getMedia('images')->first())
                    <img src="{{auth()->user()->getMedia('images')->first()->getUrl('thumb')}}" class="card-img-top rounded-circle border-white" alt="User" />
                    @else
                    <img src="https://ui-avatars.com/api/?name={{auth()->user()->name}}" class="card-img-top rounded-circle border-white" alt="User" />
                    @endif
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hi, {{auth()->user()->name}}</h2>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            @role('admin')
            <li class="nav-item">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-master-data">
                    <span>
                        <span class="sidebar-icon">
                            <i class="fas fa-table"></i>
                        </span>
                        <span class="sidebar-text">Master Data</span>
                    </span>
                    <span class="link-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </span>
                <div class="multi-level collapse" role="list" id="submenu-master-data">
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.index')}}">
                                <span class="sidebar-text"><i class="fas fa-user"></i> User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endrole
            @role('admin')
            <li class="nav-item">
                <a href="{{route('activity-log.index')}}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="fas fa-clock"></i>
                    </span>
                    <span class="sidebar-text">Activity Log</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</nav>