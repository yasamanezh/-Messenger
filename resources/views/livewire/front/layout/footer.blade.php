<div>
    <!-- Start Footer Wrap Area -->
    <div class="footer-wrap-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}" class="logo">
                            <img src="/storage/{{$setting->logo}}" alt="logo">
                        </a>
                        <p>{{$this->getTranslate('content_left',$footer,'true')}}</p>
                        <ul class="social-links">
                            @if($social)
                            <li><a href="{{$social->instagram}}" target="_blank"><i class="ri-instagram-line"></i></a></li>
                            <li><a href="{{$social->twitter}}" target="_blank"><i class="ri-twitter-fill"></i></a></li>
                            <li><a href="{{$social->linkdin}}" target="_blank"><i class="ri-linkedin-fill"></i></a></li>
                            <li><a href="{{$social->email}}" target="_blank"><i class="ri-messenger-fill"></i></a></li>
                            <li><a href="{{$social->instagram}}" target="_blank"><i class="ri-github-fill"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget pl-2">
                        <h3>{{$this->getTranslate('company',$footer,'true')}}</h3>
                        <ul class="links-list">
                            @if($Company_links)
                            @foreach($Company_links as $link)
                              <li>
                              @if(count($this->getHref($link)) == 1)
                                <a href="{{route($this->getHref($link)[0])}}" class="nav-link">{{$this->getTranslate('title',$link)}}
                                </a>
                                @else
                                <a href="{{route($this->getHref($link)[0],$this->getHref($link)[1])}}" class="nav-link">{{$this->getTranslate('title',$link)}}
                                </a>
                                @endif
                            </li>
                            @endforeach

                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h3>{{$this->getTranslate('support',$footer,'true')}}</h3>
                        <ul class="links-list">
                            @if($Support_links)
                            @foreach($Support_links as $link)
                              <li>
                              @if(count($this->getHref($link)) == 1)
                                <a href="{{route($this->getHref($link)[0])}}" class="nav-link">{{$this->getTranslate('title',$link)}}
                                </a>
                                @else
                                <a href="{{route($this->getHref($link)[0],$this->getHref($link)[1])}}" class="nav-link">{{$this->getTranslate('title',$link)}}
                                </a>
                                @endif
                            </li>
                            @endforeach

                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h3>{{$this->getTranslate('Useful_Links_text',$footer,'true')}}</h3>
                        <ul class="links-list">
                            @if($Useful)
                            @foreach($Useful as $link)
                            <li>
                              @if(count($this->getHref($link)) == 1)
                                <a href="{{route($this->getHref($link)[0])}}" class="nav-link">{{$this->getTranslate('title',$link)}}
                                </a>
                                @else
                                <a href="{{route($this->getHref($link)[0],$this->getHref($link)[1])}}" class="nav-link">{{$this->getTranslate('title',$link)}}
                                </a>
                                @endif
                            </li>
                            @endforeach

                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h3>{{$this->getTranslate('title_right',$footer,'true')}}</h3>
                        <p>{{$this->getTranslate('content_right',$footer,'true')}}</p>
                        @if($success)
                        <div class="alert alert-success">
                            <ul>
                                <li>{{$success}}</li>
                            </ul>
                        </div>

                        @endif
                        <form class="newsletter-form" data-toggle="validator">
                            <input type="text" wire:model.defer="email" class="input-newsletter" placeholder="Your Email" name="EMAIL" required autocomplete="off">
                            <button  wire:click.prevent="saveEmail()"><i class="ri-send-plane-2-line"></i></button>
                            @error('email') <div id="validator-newsletter" class="form-result">{{$message}}</div>@endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <p>Copyright <script>document.write(new Date().getFullYear())</script> <strong>Pakap</strong>. All Rights Reserved by <a href="https://envytheme.com/" target="_blank">EnvyTheme</a></p>
            </div>
        </div>
    </div>
    <!-- End Footer Wrap Area -->


</div>
