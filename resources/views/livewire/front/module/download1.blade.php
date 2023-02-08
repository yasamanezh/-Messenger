<div>
   <!-- Start App Download Area -->
        <div class="app-download-area pb-100">
            <div class="container">
                <div class="app-download-inner">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="app-download-content">
                                <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                                <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                                <p>{{$this->getTranslate('content',$module)}}</p>
                                <div class="btn-box">
                                    <a href="#" class="playstore-btn" target="_blank">
                                        <img src="{{asset('front/ltr/assets/img/play-store.png')}}" alt="image">
                                        Get It On
                                        <span>Google Play</span>
                                    </a>
                                    <a href="#" class="applestore-btn" target="_blank">
                                        <img src="{{asset('front/ltr/assets/img/apple-store.png')}}" alt="image">
                                        Download on the
                                        <span>Apple Store</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="app-download-image" data-aos="fade-up">
                                <img src="/storage/{{$module->file1}}" alt="app-img">
                            </div>
                        </div>
                    </div>
                    <div class="shape5"><img src="{{asset('front/ltr/assets/img/shape/shape4.png')}}" alt="shape4"></div>
                    <div class="lines">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End App Download Area -->
</div>
