<div>
    <!-- Start Navbar Area -->
    <div class="navbar-area pakap-new-navbar-area">
        <div class="pakap-responsive-nav">
            <div class="container">
                <div class="pakap-responsive-menu">
                    <div class="logo">           


                        <a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">
                            <img src="/storage/{{$setting->logo}}" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pakap-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">
                        <img src="/storage/{{$setting->logo}}" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="#" class="dropdown-toggle nav-link">Languages</a>
                                <ul class="dropdown-menu">
                                    @foreach($translations as $translation)
                                    <li class="nav-item">
                                        <a href="{{$this->getUrl($translation->language->code)}}" class="nav-link" style="display: flex;">

                                            <div class="h-6 w-6 flex-shrink-0 mr-1 mr-2" style="width: 30px;height: 30px">
                                                <x-dynamic-component class="w-6 h-6" component="flag-language-{{ $translation->language->code }}" />
                                            </div>  
                                            <span style="margin-left: 20px">{{$translation->language->name}}</span>

                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                            @foreach($menus as $menu)
                            @if(count($this->haveChild($menu->id)) >=1)
                            <li class="nav-item">
                                <a href="#" class="dropdown-toggle nav-link">{{$this->getTranslate('title',$menu)}}</a>   
                            </li>
                            @else
                            <li class="nav-item">
                                @if(count($this->getHref($menu)) == 1)
                                <a href="{{route($this->getHref($menu)[0])}}" class="nav-link">{{$this->getTranslate('title',$menu)}}
                                </a>
                                @else
                                <a href="{{route($this->getHref($menu)[0],$this->getHref($menu)[1])}}" class="nav-link">{{$this->getTranslate('title',$menu)}}
                                </a>
                                @endif
                            </li>

                            @endif
                            @endforeach

                        </ul>
                        <div class="others-option">
                            @if(auth()->user())
                            <a href="{{route('login')}}" class="default-btn">{{__('Account')}}</a>

                            @else
                            <a href="{{route('login')}}" class="default-btn">{{__('Login')}} / {{__('Register')}}  </a>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</div>
