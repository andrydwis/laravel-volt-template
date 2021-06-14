<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-end w-100" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown">
                        <div class="media d-flex align-items-center">
                            @if(auth()->user()->getMedia('images')->first())
                            <img class="avatar rounded-circle" alt="Image placeholder" src="{{auth()->user()->getMedia('images')->first()->getUrl('thumb')}}" />
                            @else
                            <img class="avatar rounded-circle" alt="Image placeholder" src="https://ui-avatars.com/api/?name={{auth()->user()->name}}" />
                            @endif
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small fw-bold text-gray-900">{{auth()->user()->name}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                        <a class="dropdown-item d-flex align-items-center" href="{{route('profile.show')}}">
                            <i class="fas fa-user-circle me-1"></i>
                            Profile
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fas fa-cog me-1"></i>
                            Settings
                        </a>
                        <div role="separator" class="dropdown-divider my-1"></div>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="fas fa-sign-out-alt me-1"></i>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>