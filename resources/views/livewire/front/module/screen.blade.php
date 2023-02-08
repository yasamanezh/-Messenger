<div>
     <!-- Start App Screenshots Area -->
        <div class="app-screenshots-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                    <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                </div>
                <div class="app-screenshots-slides owl-carousel owl-theme">
                    @foreach($images as $image)
                    <div class="single-screenshot-card">
                        <img src="storage/{{$image->file}}" alt="screenshots">
                    </div>
                    @endforeach
                   
                </div>
            </div>
        </div>
        <!-- End App Screenshots Area -->

</div>
