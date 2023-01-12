<!-- Sidemenu -->
<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="">
            <img src="{{asset('admin/img/brands/logo-light.png')}}" class="header-brand-img desktop-logo" alt="logo">
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
           
            <li class="nav-item">
                <a class="nav-link" href=""><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-home sidemenu-icon"></i><span class="sidemenu-label">Dashboard</span></a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href=""><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-package sidemenu-icon"></i><span class="sidemenu-label">Languages</span></a>
            </li>
       
            <li class="nav-item  @if(Request::routeIs('admin.blogs') || Request::routeIs('admin.blog.add')) active @endif">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span>
                    <span class="shape2"></span><i class="ti-receipt sidemenu-icon"></i><span class="sidemenu-label">Blog</span><i
                        class="angle fe fe-chevron-left"></i></a>
                <ul class="nav-sub">
                    
                    <li class="nav-sub-item @if(Request::routeIs('admin.blogs') || Request::routeIs('admin.blog.add')) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.blogs')}}">Blogs</a>
                    </li>
                    <li class="nav-sub-item @if(Request::routeIs('admin.blogs')) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.blogs')}}">Posts</a>
                    </li>
                   
                </ul>
            </li>
            <li class="nav-header"><span class="nav-label">Design</span></li>
            <li class="nav-item">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span>
                    <span class="shape2"></span><i class="ti-face-smile sidemenu-icon"></i><span class="sidemenu-label">Help Center</span><i
                        class="angle fe fe-chevron-left"></i></a>
                <ul class="nav-sub">
                    
                    <li class="">
                        <a class="nav-sub-link" href="">category</a>
                    </li>
                    <li class="">
                        <a class="nav-sub-link" href="">faq</a>
                    </li>
                   
                </ul>
            </li>
             <li class="nav-item">
                <a class="nav-link" href=""><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-home sidemenu-icon"></i><span class="sidemenu-label">Home Page</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-palette sidemenu-icon"></i><span class="sidemenu-label">All Pages</span></a>
            </li>
            <li class="nav-header"><span class="nav-label">Setting</span></li>
            <li class="nav-item">
                <a class="nav-link" href=""><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-write sidemenu-icon"></i><span class="sidemenu-label">General</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-email sidemenu-icon"></i><span class="sidemenu-label">Social</span></a>
            </li>
          
        </ul>
    </div>
</div>
<!-- End Sidemenu -->
