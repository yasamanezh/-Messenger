<div>
   @if($modules)
     <!-- Start Gradient Funfacts Area -->
        <div class="gradient-funfacts-area pt-100 pb-75">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($modules as $item)
                    <div class="col-lg-3 col-sm-6 col-md-6">
                        <div class="single-funfacts-card">
                            <div class="icon">
                                <i class="{{$item->image}}"></i>
                            </div>
                            <p>{{$this->getTranslate('title',$item)}}</p>
                            <h3><span class="odometer" data-count="{{$item->customTranslate('en')->short_content}}">00</span><span class="sign">{{$this->getTranslate('content',$item)}}</span></h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Gradient Funfacts Area -->
        @endif

</div>
