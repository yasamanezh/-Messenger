<div>
    <!-- Start Navbar Area -->
    <div class="navbar-area pakap-new-navbar-area">
        <div class="pakap-responsive-nav">
            <div class="container">
                <div class="pakap-responsive-menu">
                    <div class="logo">
                        <a href="index.html"><img src="assets/img/black-logo.png" alt="logo"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pakap-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="index.html"><img src="assets/img/black-logo.png" alt="logo"></a>
                    <div class="collapse navbar-collapse mean-menu">
                        <ul class="navbar-nav">
                            @foreach($menus as $menu)                          
                            <li class="nav-item">
                                
                                <a href="#" class="dropdown-toggle nav-link">{{$this->getTitle($menu)}}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="about-simple.html" class="nav-link">About Simple{{$this->haveChild($menu->id)}}</a></li>
                                    <li class="nav-item"><a href="about-modern.html" class="nav-link">About Modern</a></li>
                                    <li class="nav-item"><a href="#" class="dropdown-toggle nav-link">Features</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href="features-1.html" class="nav-link">Features 1</a></li>
                                            <li class="nav-item"><a href="features-2.html" class="nav-link">Features 2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                               
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