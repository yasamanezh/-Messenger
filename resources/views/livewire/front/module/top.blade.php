<div>
    @if($module)
    <!-- Start New App Main Banner Wrap Area -->
    <div class="new-app-main-banner-wrap-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="new-app-main-banner-wrap-content">
                        <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                        <h1>{{$this->getTranslate('short_content',$module)}}</h1>
                        <p>{{$this->getTranslate('content',$module)}} </p>

                         <ul class="user-info">
                              @foreach($images as $image)
                                <li><img src="storage/{{$image->file}}" class="rounded-circle" alt="user"></li>
                                @endforeach

                                <li class="title">
                                    {{$this->getTranslate('count_use',$module,'true')}}
                                   
                                </li>
                            </ul>

                        <div class="app-btn-box">
                            <a href="{{$setting->app_store_link}}" class="applestore-btn" target="_blank">
                                <img src="{{asset('front/ltr/assets/img/apple-store.png')}}" alt="{{__('Apple Store')}}">
                                {{__('Download on the')}}
                                <span>{{__('Apple Store')}}</span>
                            </a>

                            <a href="{{$setting->google_play_link}}" class="playstore-btn" target="_blank">
                                <img src="{{asset('front/ltr/assets/img/play-store.png')}}" alt="{{__('Google Play')}}')}}">
                                {{__('Get It On')}}

                                <span>{{__('Google Play')}}</span>
                            </a>
                            
                           
                        </div>
                         @if($file) 
                         <div class="app-btn-box text-center">
                             
                             <a download  href="storage/{{$file}}"  class="applestore-btn" target="_blank" style="width: 180px">
                            <img src="{{asset('front/ltr/assets/img/download.png')}}" alt="{{__('Windows')}}">
                                    {{__('Get it from')}}

                                <span>{{__('Windows')}}</span>
                            </a>
                             
                         </div>
                            @endif
                    </div>
                </div> 
                <div class="col-lg-6 col-md-12">
                    <div class="new-app-main-banner-wrap-image" data-aos="fade-left" data-aos-duration="2000">
                        <img src="storage/{{$module->file1}}" alt="{{$this->getTranslate('title',$module)}}">

                        <div class="wrap-image-shape-1">
                            <img src="{{asset('front/ltr/assets/img/more-home/banner/shape-3.png')}}" alt="{{$this->getTranslate('title',$module)}}">
                        </div>
                        <div class="wrap-image-shape-2">
                            <img src="{{asset('front/ltr/assets/img/more-home/banner/shape-4.png')}}" alt="{{$this->getTranslate('title',$module)}}">
                        </div>
                        <div class="banner-circle">
                            <img src="{{asset('front/ltr/assets/img/more-home/banner/banner-circle.png')}}" alt="{{$this->getTranslate('title',$module)}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="new-app-main-banner-wrap-shape">
            <img src="{{asset('front/ltr/assets/img/more-home/banner/shape-5.png')}}" alt="{{$this->getTranslate('title',$module)}}">
        </div>
    </div>
    <!-- End New App Main Banner Wrap Area -->
    @endif

</div>
