<div>
    <!-- Start Navbar Area -->
    <div class="navbar-area pakap-new-navbar-area">
        
        <div class="pakap-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">
                        <img src="/storage/{{$setting->logo}}" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu">
                        <ul class="navbar-nav">
                            @foreach($menus as $menu)
                            @if(count($this->haveChild($menu->id)) >=1)
                            <li class="nav-item">
                                <a href="#" class="dropdown-toggle nav-link"> {{$this->getTranslate('title',$menu)}}</a>  
                                <ul class="dropdown-menu">
                                    @foreach($this->haveChild($menu->id) as $child)
                                    <li class="nav-item">
                                        @if(count($this->getHref($child)) == 4)
                                        <a href="{{$child->slug}}"   class="nav-link">
                                             {{$this->getTranslate('title',$child)}}
                                        </a>
                                        @elseif(count($this->getHref($child)) == 1)
                                        <a href="{{route($this->getHref($child)[0])}}" class="nav-link">
                                            {{$this->getTranslate('title',$child)}}
                                        </a>
                                        @else
                                        <a href="{{route($this->getHref($child)[0],$this->getHref($child)[1])}}" class="nav-link">
                                            {{$this->getTranslate('title',$child)}}
                                        </a>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            <li class="nav-item">
                                @if(count($this->getHref($menu)) == 4)
                                <a href="{{$menu->slug}}"   class="nav-link">
                                             {{$this->getTranslate('title',$menu)}}
                                 </a>
                                @elseif(count($this->getHref($menu)) == 1)
                                <a href="{{route($this->getHref($menu)[0])}}" class="nav-link @if(Request::routeIs($this->getHref($menu)[0])) active @endif">
                                    {{$this->getTranslate('title',$menu)}}
                                </a>
                                @else
                                <a href="{{route($this->getHref($menu)[0],$this->getHref($menu)[1])}}" class="nav-link @if(Request::routeIs($this->getHref($menu)[0])) active @endif">
                                    {{$this->getTranslate('title',$menu)}}
                                </a>
                                @endif
                            </li>

                            @endif
                            @endforeach

                        </ul>
                        <div class="others-option">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                                <div class="dropdown show">
                                    <a class="btn  dropdown-toggle mt-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="main-img-user font-bold">
                                             <i class="ri-global-line"></i>
                                             <span class="initialism">{{app()->getLocale()}}</span>
                                           
                                            
                                        </span>

                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >

                                        @foreach($translations as $translation)
                                        
                                        <a class="dropdown-item font" href="{{$this->getUrl($translation->language->code)}}">{{$translation->language->name}}</a>
                                        @endforeach
                                    </div>


                                </div>
                                @if(auth()->user())
                                <div class="dropdown show">
                                    <a class="btn  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="main-img-user"><img style="width: 30px" alt="{{$user->name}}" src="@if($user->profile_photo_path)  /storage/{{$user->profile_photo_path }} @else {{asset('admin/img/svgs/user.svg')}} @endif"></span>

                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item font" href="{{$multiLanguage ? route('front.profile.language',app()->getlocale()) : route('front.profile')}}">{{__('Profile')}}</a>
                                        <a class="dropdown-item" href="{{$multiLanguage ? route('front.ticket.language',app()->getlocale()) : route('front.ticket')}}">{{__('Tickets')}}</a>
                                        
                                        @if($setting->is_payment)
                                        <a class="dropdown-item" href="{{$multiLanguage ? route('front.order.language',app()->getlocale()) : route('front.order')}}">{{__('Orders')}}</a>
                                        @endif
                                        <hr>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="nav-item">
                                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        this.closest('form').submit();
                                                   " role="button">
                                                    <i class="fe fe-power"></i> {{__('Sign Out')}}
                                                </a>
                                            </div>
                                        </form>

                                    </div>


                                </div>
                                @else
                                <a href="{{route('login')}}" class="default-btn">{{__('Login')}} / {{__('Register')}}  </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</div>
