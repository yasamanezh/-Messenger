<div>
    
        <!-- Start Key Features Area -->
        <div class="key-features-area bg-transparent-with-color pt-100 pb-100">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">KEY FEATURES</span>
                    <h2>Most Probably Included Best Features Ever</h2>
                </div>

                <div class="row justify-content-center">
                    
                    
                    @foreach($keyas as $key=>$value)
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
