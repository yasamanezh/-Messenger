<div>
    @if($module)
      <!-- Start App Pricing Area -->
        <div class="app-pricing-area pt-100 pb-75">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="app-pricing-section-title">
                            <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                            <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                                <a href="{{$lang}}/{{$module->more_link}}" class="link-btn">{{$this->getTranslate('more_text',$module,'true')}}</a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="row align-items-center">
                            @if($packs)
                           @foreach($packs as $pack) 
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="single-app-pricing-box with-border-radius">
                                    <div class="title">
                                        <h3>{{$this->getTranslate('title',$pack)}}</h3>
                                        <p>{{$this->getTranslate('short_content',$pack)}}</p>
                                    </div>
                                    
                                    <span class="popular">{{$loop->first ? 'Most Popular' : ''}}</span>
                                    <div class="price">
                                        ${{$pack->price}} <span>/Month</span>
                                    </div>
                                    <div class="pricing-btn">
                                        <a href="#" class="default-btn">Purchase Plan</a>
                                    </div>
                                    <ul class="features-list">
                                @foreach($pack->options as $option)
                                <li><i class="ri-check-line"></i>{{$this->getTranslate('title',$option)}}</li>
                                
                                @endforeach
                               
                            </ul>
                                </div>
                            </div>
                           @endforeach
                           @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End App Pricing Area -->
        @endif

</div>
