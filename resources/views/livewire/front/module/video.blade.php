<div>
    <!-- Start App Video Area -->
        <div class="app-video-area pb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="app-intro-video-box">
                            <img src="storage/{{$module->file1}}" alt="video-img">
                            <a href="https://www.youtube.com/watch?v={{$module->file2}}" class="video-btn popup-video"><i class="ri-play-line"></i></a>

                            <div class="intro-video-shape">
                                <img src="{{asset('front/ltr//assets/img/more-home/video/shape-3.png')}}" alt="image">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="app-intro-video-content">
                            <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                            <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                            <p>{{$this->getTranslate('content',$module)}}</p>
                            <a href="contact.html" class="default-btn">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End App Video Area -->
</div>
