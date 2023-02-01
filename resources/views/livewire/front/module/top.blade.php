<div>
       <!-- Start New App Main Banner Wrap Area -->
        <div class="new-app-main-banner-wrap-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="new-app-main-banner-wrap-content">
                            <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                            <h1>{{$this->getTranslate('short_content',$module)}}</h1>
                            <p>{{$this->getTranslate('content',$module)}} </p>

                            <br><br><br>

                          <livewire:front.module.button />
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <div class="new-app-main-banner-wrap-image" data-aos="fade-left" data-aos-duration="2000">
                            <img src="storage/{{$module->file1}}" alt="image">

                            <div class="wrap-image-shape-1">
                                <img src="{{asset('front/ltr/assets/img/more-home/banner/shape-3.png')}}" alt="image">
                            </div>
                            <div class="wrap-image-shape-2">
                                <img src="{{asset('front/ltr/assets/img/more-home/banner/shape-4.png')}}" alt="image">
                            </div>
                            <div class="banner-circle">
                                <img src="{{asset('front/ltr/assets/img/more-home/banner/banner-circle.png')}}" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="new-app-main-banner-wrap-shape">
                <img src="{{asset('front/ltr/assets/img/more-home/banner/shape-5.png')}}" alt="image">
            </div>
        </div>
        <!-- End New App Main Banner Wrap Area -->
        
</div>
