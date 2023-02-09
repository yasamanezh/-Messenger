<div>
    <!-- Start Navbar Area -->
    <div class="navbar-area pakap-new-navbar-area">
        <div class="pakap-responsive-nav">
            <div class="container">
                <div class="pakap-responsive-menu">
                    <div class="logo">
                        <a href="index.html"><img src="{{asset('front/ltr/assets/img/black-logo.png')}}" alt="logo"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pakap-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="index.html"><img src="{{asset('front/ltr/assets/img/black-logo.png')}}" alt="logo"></a>
                    <div class="collapse navbar-collapse mean-menu">
                        <ul class="navbar-nav">
                            @foreach($menus as $menu)                          
                            <li class="nav-item">
                                <a href="#" class="dropdown-toggle nav-link">{{$this->getTranslate('title',$menu)}}</a>   
                            </li>
                            @endforeach
                        </ul>
                        <div class="others-option">
                            <a href="contact.html" class="default-btn">Get Started</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->
</div>
