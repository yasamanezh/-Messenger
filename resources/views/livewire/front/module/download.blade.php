<div>
     @if($module)
     <!-- Start New App Download Area -->
        <div class="new-app-download-wrap-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="new-app-download-content">
                            <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                            <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                            <p>{{$this->getTranslate('content',$module)}}</p>
                            <div class="btn-box color-wrap">
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
                        <div class="new-app-download-image text-end" data-aos="fade-up">
                            <img src="/storage/{{$module->file1}}" alt="{{$this->getTranslate('title',$module)}}">

                            <div class="download-circle">
                                <img src="{{asset('front/ltr/assets/img/more-home/app-download/download-circle.png')}}" alt="{{$this->getTranslate('title',$module)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-download-shape-1">
                <img src="{{asset('front/ltr/assets/img/more-home/app-download/shape-1.png')}}" alt="{{$this->getTranslate('title',$module)}}">
            </div>
            <div class="app-download-shape-2">
                <img src="{{asset('front/ltr/assets/img/more-home/app-download/shape-2.png')}}" alt="{{$this->getTranslate('title',$module)}}">
            </div>
        </div>
        <!-- End New App Download Area -->
        
       @endif
</div>
