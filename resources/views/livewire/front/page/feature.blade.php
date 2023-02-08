<div>
    <livewire:front.page.layout.title :title="$this->getTranslate('title',$module)" />
 <!-- Start Features Area -->
        <div class="features-area pt-100 pb-75">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="features-inner-content">
                            <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                            <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                            <p>{{$this->getTranslate('content',$module)}}</p>
                            <div class="btn-box">
                                <livewire:front.module.free-trial />
                                <a href="{{$lang}}/{{$module->more_link}}" class="link-btn">{{$this->getTranslate('more_text',$module,'true')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 features-inner-list">
                        <div class="row justify-content-center">
                            
                            @foreach($keyas1 as $key=>$value)
             
                            <div class="col-lg-6 col-sm-6">
                                <div class="features-inner-card @if($key+1 == 2 || $key+1 ==3)  with-box-shadow @endif">
                                    <div class="icon">
                                        <i class="{{$value->image}}"></i>
                                        
                                        <h3>{{$this->getTranslate('title',$value)}}</h3>
                                    </div>
                                    <p>{{$this->getTranslate('short_content',$value)}}</p>
                                </div>
                            </div>
                            @endforeach

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Features Area -->
             <!-- Start Key Features Area -->
        <div class="key-features-area bg-transparent-with-color pt-100 pb-100">
            <div class="container">
              

                <div class="row justify-content-center">
                    
                    
                    @foreach($keyas2 as $key=>$value)
                    <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                        <div class="key-features-card bg-color-two style-two">
                            <div class="icon @if($key+1 == 2 ||$key+1 == 4 ||$key+1 == 6 ) bg2  @endif">
                                <i class="{{$value->image}}"></i>
                            </div>
                            <h3>{{$this->getTranslate('title',$value)}}</h3>
                            <p>{{$this->getTranslate('short_content',$value)}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="key-features-btn">
                     <livewire:front.module.free-trial />
                </div>
            </div>
        </div>
        <!-- End Key Features Area --> 
        
</div>