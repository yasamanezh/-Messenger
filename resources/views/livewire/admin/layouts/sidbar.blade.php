<!-- Sidemenu -->
<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="{{route('front.home')}}">
            <img src="/storage/{{$setting->logo}}" class="header-brand-img desktop-logo" alt="logo">
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            @can('show_dashboard')
            <li class="nav-item @if(Request::routeIs('Dashboard')) active @endif">
                <a class="nav-link" href="{{route('Dashboard')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-home sidemenu-icon"></i>
                    <span class="sidemenu-label">Dashboard</span>
                </a>
            </li>
            @endcan
            @can('show_language')
            <li class="nav-item @if(Request::routeIs('admin.language')) active @endif">
                <a class="nav-link" href="{{route('admin.language')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i  class="ti-package sidemenu-icon"></i>
                    <span class="sidemenu-label">Languages</span>
                </a>
            </li>
            @endcan   
            <li class="nav-item  @if(Request::routeIs('admin.comments') || Request::routeIs('admin.comment.eit') || Request::routeIs('admin.blog.edit') || Request::routeIs('admin.blogs') || Request::routeIs('admin.blog.add') || Request::routeIs('admin.posts') || Request::routeIs('admin.post.add') || Request::routeIs('admin.post.edit')) active @endif">
                <a class="nav-link with-sub" href="#">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-receipt sidemenu-icon"></i>
                    <span class="sidemenu-label">Blog</span>
                    <i class="angle fe fe-chevron-left"></i>
                </a>
                <ul class="nav-sub">
                    @can('show_blog')
                    <li class="nav-sub-item @if(Request::routeIs('admin.blog.edit') || Request::routeIs('admin.blog.add') || Request::routeIs('admin.blogs') ) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.blogs')}}">Blogs</a>
                    </li>
                    @endcan
                    @can('show_post')
                    <li class="nav-sub-item @if(Request::routeIs('admin.posts') || Request::routeIs('admin.post.add') || Request::routeIs('admin.post.edit')) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.posts')}}">Posts</a>
                    </li>
                    @endcan
                    @can('show_comment')
                    <li class="nav-sub-item @if(Request::routeIs('admin.comments') || Request::routeIs('admin.comment.eit') ) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.comments')}}">Comments</a>
                    </li>
                    @endcan


                </ul>
            </li>

            <li class="nav-item  @if(Request::routeIs('admin.packs') || Request::routeIs('admin.pack.add')|| Request::routeIs('admin.pack.edit') ) active @endif">
                <a class="nav-link with-sub" href="#">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-server sidemenu-icon"></i>
                    <span class="sidemenu-label">Package</span>
                    <i class="angle fe fe-chevron-left"></i>
                </a>
                <ul class="nav-sub">
                    @can('show_pack')
                    <li class="nav-sub-item @if(Request::routeIs('admin.packs') ||Request::routeIs('admin.pack.add') || Request::routeIs('admin.pack.edit') ) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.packs')}}">Package lists</a>
                    </li>
                    @endcan
                    @can('show_option')
                    <li class="nav-sub-item  @if(Request::routeIs('admin.pack.options') ||Request::routeIs('admin.pack.option.add') || Request::routeIs('admin.pack.option.edit') ) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.pack.options')}}">Options</a>
                    </li>
                    @endcan

                </ul>
            </li>
            @can('show_faq')
            <li class="nav-item @if(Request::routeIs('admin.helps')) active @endif">
                <a class="nav-link with-sub" href="{{route('admin.helps')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-face-smile sidemenu-icon"></i>
                    <span class="sidemenu-label">Help Center</span>
                    <i class="angle fe fe-chevron-left"></i>
                </a>
                <ul class="nav-sub @if(Request::routeIs('admin.faqs') ||Request::routeIs('admin.helps') ) active @endif">
                    <li class="">
                        <a class="nav-sub-link" href="{{route('admin.helps')}}">category</a>
                    </li>
                    <li class="">
                        <a class="nav-sub-link" href="{{route('admin.faqs')}}">faq</a>
                    </li>

                </ul>
            </li>
            @endcan
            <li class="nav-header"><span class="nav-label">Design</span></li>
            @can('show_design')
            <li class="nav-item  @if(Request::routeIs('admin.modules')) active @endif">
                <a class="nav-link" href="{{route('admin.modules')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-home sidemenu-icon"></i>
                    <span class="sidemenu-label">Home Page</span>
                </a>
            </li>
            @endcan
            @can('show_page')
            <li class="nav-item  @if(Request::routeIs('admin.pages')) active @endif">
                <a class="nav-link" href="{{route('admin.pages')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-palette sidemenu-icon"></i>
                    <span class="sidemenu-label">All Pages</span>
                </a>
            </li>
            @endcan
            @can('show_design')
            <li class="nav-item  @if(Request::routeIs('admin.footer')) active @endif">
                <a class="nav-link" href="{{route('admin.footer')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-palette sidemenu-icon"></i>
                    <span class="sidemenu-label">footer</span>
                </a>
            </li>

            <li class="nav-item @if(Request::routeIs('admin.menus')) active @endif ">
                <a class="nav-link" href="{{route('admin.menus')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i  class="ti-package sidemenu-icon"></i>
                    <span class="sidemenu-label">menu</span>
                </a>
            </li>
            @endcan

            <li class="nav-header"><span class="nav-label">Setting</span></li>
            @can('show_setting')
            <li class="nav-item   @if(Request::routeIs('admin.setting') ) active @endif">
                <a class="nav-link" href="{{route('admin.setting')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-write sidemenu-icon"></i>
                    <span class="sidemenu-label">General</span>
                </a>
            </li>
           <li class="nav-item   @if(Request::routeIs('admin.order') ) active @endif">
                <a class="nav-link" href="{{route('admin.order')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-face-smile sidemenu-icon"></i>
                    <span class="sidemenu-label">Orders</span>
                </a>
            </li>
          
            
            <li class="nav-item   @if(Request::routeIs('admin.images') ) active @endif">
                <a class="nav-link" href="{{route('admin.images')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-palette sidemenu-icon"></i>
                    <span class="sidemenu-label">Image Manager</span>
                </a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/front-end-builder">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-write sidemenu-icon"></i>
                    <span class="sidemenu-label">Page Builder</span>
                </a>
            </li>
            
            <li class="nav-item  @if(Request::routeIs('admin.socials')) active @endif ">
                <a class="nav-link" href="{{route('admin.socials')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i  class="ti-email sidemenu-icon"></i>
                    <span class="sidemenu-label">Social</span>
                </a>
            </li>
            @endcan
            @can('show_contact')
            <li class="nav-item @if(Request::routeIs('admin.contacts')) active @endif ">
                <a class="nav-link" href="{{route('admin.contacts')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i  class="ti-package sidemenu-icon"></i>
                    <span class="sidemenu-label">Contacts</span>
                </a>
            </li>
            @endcan

            <li class="nav-header"><span class="nav-label">users</span></li>
            @can('show_user')
            <li class="nav-item  @if(Request::routeIs('admin.users') || Request::routeIs('admin.user.add') || Request::routeIs('admin.user.edit')) active @endif">
                <a class="nav-link" href="{{route('admin.users')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-user sidemenu-icon"></i>
                    <span class="sidemenu-label">user list</span>
                </a>
            </li>
            @endcan
            @can('show_role')
            <li class="nav-item  @if(Request::routeIs('admin.roles') || Request::routeIs('admin.role.add') || Request::routeIs('admin.role.edit')) active @endif">
                <a class="nav-link" href="{{route('admin.roles')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i  class="ti-lock sidemenu-icon"></i>
                    <span class="sidemenu-label">roles</span>
                </a>
            </li>  
            @endcan
            @can('show_AdminLogs')
            <li class="nav-item @if(Request::routeIs('admin.userlogs')) active @endif">
                <a class="nav-link" href="{{route('admin.userlogs')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i  class="ti-bar-chart-alt sidemenu-icon"></i>
                    <span class="sidemenu-label">Activity</span>
                </a>
            </li>
            @endcan
            @can('show_newsletter')
            <li class="nav-item @if(Request::routeIs('admin.newslatters')) active @endif">
                <a class="nav-link" href="{{route('admin.newslatters')}}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i  class="ti-email sidemenu-icon"></i>
                    <span class="sidemenu-label">Newsletters</span>
                </a>
            </li>
            @endcan
            @can('show_ticket')
            <li class="nav-item  @if(Request::routeIs('admin.tickets') || Request::routeIs('admin.tickets.part') ) active @endif">
                <a class="nav-link with-sub" href="#">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-receipt sidemenu-icon"></i>
                    <span class="sidemenu-label">tickets</span>
                    <i class="angle fe fe-chevron-left"></i>
                </a>
                <ul class="nav-sub">
                    <li class="nav-sub-item @if(Request::routeIs('admin.tickets') || Request::routeIs('admin.ticket.add') || Request::routeIs('admin.ticket.edit')) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.tickets')}}">lists</a>
                    </li>
                    <li class="nav-sub-item @if(Request::routeIs('admin.tickets.part') || Request::routeIs('admin.ticket.part.add') || Request::routeIs('admin.ticket.part.edit')) active @endif">
                        <a class="nav-sub-link" href="{{route('admin.tickets.part')}}">parts</a>
                    </li>
                </ul>
            </li>
            @endcan 
        </ul>
    </div>
</div>
<!-- End Sidemenu -->
