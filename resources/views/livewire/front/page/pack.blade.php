<div>
       @if($page)
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{$this->getTranslate('title',$page)}}</h2>
                    <ul>
                        <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>
                        <li>{{$this->getTranslate('title',$page)}}</li>
                    </ul>
                </div>
            </div>
            <div class="divider"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="banner-shape1">
                <img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="{{$this->getTranslate('title',$page)}}">
            </div>
        </div> 

 <!-- Start Pricing Area -->
        <div class="pricing-area pt-100 pb-75">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                    <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                </div>
                <div class="row align-items-center justify-content-center">
                      @foreach($packs as $pack)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-pricing-box">
                            <div class="title">
                                <h3>{{$this->getTranslate('title',$pack)}}</h3>
                                <p>{{$this->getTranslate('short_content',$pack)}}</p>
                            </div>
                            <div class="price">
                                ${{$pack->price}} <span>{{$this->getTranslate('month_text',$pack,'true')}}</span>
                            </div>
                            <a href="{{$setting->app_link}}" class="default-btn">{{__('Purchase Plan')}}</a>
                            <ul class="features-list">
                                @foreach($pack->options as $option)
                                <li><i class="ri-check-line"></i>{{$this->getTranslate('title',$option)}}</li>
                                
                                @endforeach
                               
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="shape12"><img src="{{asset('front/ltr/assets/img/shape/shape11.png')}}" alt="{{$this->getTranslate('title',$page)}}"></div>
            <div class="shape13"><img src="{{asset('front/ltr/assets/img/shape/shape15.png')}}" alt="{{$this->getTranslate('title',$page)}}"></div>
        </div>
        <!-- End Pricing Area -->
    <livewire:front.layout.footer :language="$multiLanguage">
@endif

</div>