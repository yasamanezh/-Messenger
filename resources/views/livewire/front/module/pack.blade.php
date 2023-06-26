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
                        @if($subError)
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{__('You have already prepared this package.')}}</li>
                            </ul>
                        </div>

                        @endif

                        @if($packError)
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{__('Unfortunately, the package you are looking for was not found.')}}</li>
                            </ul>
                        </div>

                        @endif


                        @if($packs)
                        @foreach($packs as $pack) 
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="single-app-pricing-box with-border-radius">
                                <div class="title">
                                    <h3>{{$this->getTranslate('title',$pack)}}</h3>
                                    <p>{{$this->getTranslate('content',$pack)}}</p>
                                </div>
                                @if($pack->most_popular)
                                <span class="popular">{{__('Most Popular')}}</span>
                                @endif

                                @if(!$pack->is_free)
                                <div class="price">
                                    ${{$pack->price}} <span>{{$this->getTranslate('month_text',$pack,'true')}}</span>
                                </div>
                                @else
                                <div class="price">
                                    <span>{{__('free')}}</span>
                                </div>

                                @endif

                                <div class="pricing-btn">
                                    @if($setting->is_payment)
                                    <a href=""   wire:click.prevent="addToCart({{$pack->id}})" class="default-btn">{{__('Purchase Plan')}}</a>
                                    @else
                                    <a href="{{$setting->payment_url}}"   class="default-btn">{{__('Purchase Plan')}}</a>

                                    @endif
                                    
                                
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
