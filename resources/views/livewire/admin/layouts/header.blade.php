<div>
    <!-- Main Header-->
    <div class="main-header side-header sticky" style="top: 0">
        <div class="container-fluid">
            <div class="main-header-right">
                <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
            </div>
            <div class="main-header-right">
                <div class="dropdown main-profile-menu">
                    <a class="d-flex" href="#">
                        <span class="main-img-user"><img alt="avatar" src="{{asset('admin/img/svgs/user.svg')}}"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading text-left">
                            <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                            <p class="main-notification-text">Web Admin</p>
                        </div>
                        <a class="dropdown-item" href="{{route('admin.user.edit',Auth::user()->id)}}">
                            <i class="fe fe-edit"></i> Edit Profile
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="nav-item">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit(); " role="button">
                                    <i class="fe fe-power"></i> Sign Out
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dropdown d-md-flex">
                    <a class="nav-link icon full-screen-link" href="#">
                        <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                        <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
