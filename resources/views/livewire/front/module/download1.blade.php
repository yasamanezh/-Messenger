<div>
     @if($module)
   <!-- Start App Download Area -->
        <div class="app-download-area pb-100">
            <div class="container">
                <div class="app-download-inner">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="app-download-content">
                                <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                                <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                                <p>{{$this->getTranslate('content',$module)}}</p>
                                <div class="btn-box">
                                    <a href="{{$setting->google_play_link}}" class="playstore-btn" target="_blank">
                                        <img src="{{asset('front/ltr/assets/img/play-store.png')}}" alt="{{__('Google Play')}}">
                                        {{__('Get It On')}}
                                        <span>{{__('Google Play')}}</span>
                                    </a>
                                    <a href="{{$setting->app_store_link}}" class="applestore-btn" target="_blank">
                                        <img src="{{asset('front/ltr/assets/img/apple-store.png')}}" alt="{{__('Apple Store')}}">
                                        {{__('Download on the')}}
                                        <span>{{__('Apple Store')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="app-download-image" data-aos="fade-up">
                                <img src="/storage/{{$module->file1}}" alt="{{$this->getTranslate('title',$module)}}">
                            </div>
                        </div>
                    </div>
                    <div class="shape5"><img src="{{asset('front/ltr/assets/img/shape/shape4.png')}}" alt="{{$this->getTranslate('title',$module)}}"></div>
                    <div class="lines">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End App Download Area -->
        @endif
</div>
