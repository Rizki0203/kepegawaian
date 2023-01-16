<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <div class="nav-icon dropdown-toggle {{ request()->routeIs('profile.*') ? 'fw-bold text-primary' : '' }}">
                    <div class="position-relative">
                        <a href="{{ route('profile.index') }}"><i class="me-2 align-middle" data-feather="user"></i><small style="font-size: 62%;!important">Profile</small></a>
                    </div>
                </div>

            </li>
            {{-- make line right --}}
            <div class="d-flex">
                <div class="vr"></div>
            </div>

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->avatar }}" class="avatar img-fluid me-1 rounded" alt="{{ Auth::user()->name }}" /> <span class="text-dark">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>

                    
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
