<div>
    <livewire:front.page.layout.title :title="$this->getTranslate('title',$module)" />
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
                                ${{$pack->price}} <span>/Month</span>
                            </div>
                            <a href="#" class="default-btn">Purchase Plan</a>
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
            <div class="shape12"><img src="{{asset('front/ltr/assets/img/shape/shape11.png')}}" alt="shape"></div>
            <div class="shape13"><img src="{{asset('front/ltr/assets/img/shape/shape15.png')}}" alt="shape"></div>
        </div>
        <!-- End Pricing Area -->



</div>