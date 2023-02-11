<div>
    @if($module)
    <!-- Start Feedback Wrap Area -->
        <div class="feedback-wrap-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                    <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                </div>
                <div class="feedback-swiper-wrap-slides swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($users as $user)
                        <div class="swiper-slide">
                            <div class="single-feedback-wrap-item">
                                <div class="rating">
                                    <h5>{{$this->getTranslate('title',$user)}}</h5>
                                    <div>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                    </div>
                                </div>
                                <p>‘{{$this->getTranslate('short_content',$module)}}’</p>
                                <div class="client-info">
                                    <img src="storage/{{$user->image}}" alt="user">
                                    <div class="title">
                                        <h3>{{$this->getTranslate('name',$user,'true')}}</h3>
                                        <span>{{$this->getTranslate('job',$user,'true')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-button-next" data-aos="fade-right"></div>
                    <div class="swiper-button-prev" data-aos="fade-left"></div>
                </div>
            </div>
        </div>
        <!-- End Feedback Wrap Area -->
        @endif
</div>
