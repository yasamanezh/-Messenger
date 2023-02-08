<div>
   <!-- Start Contact Info Area -->
        <div class="contact-info-area pb-100">
            <div class="container">
                <div class="contact-info-inner">
                    <h2>{{$title}}</h2>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-contact-info-box">
                                <div class="icon bg1">
                                    <i class="ri-customer-service-2-line"></i>
                                </div>
                                <h3><a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a></h3>
                                <h3><a href="tel:{{$setting->phone2}}">{{$setting->phone2}}</a></h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-contact-info-box">
                                <div class="icon">
                                    <i class="ri-earth-line"></i>
                                </div>
                                <h3><a href="{{$setting->email1}}">{{$setting->email1}}</a></h3>
                                <h3><a href="{{$setting->email2}}">{{$setting->email2}}</a></h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-contact-info-box">
                                <div class="icon bg2">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <h3>{{ $this->getTranslate('content', $setting) }}</h3>
                            </div>
                        </div>
                    </div>
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
    <!-- End Contact Info Area -->
</div>
