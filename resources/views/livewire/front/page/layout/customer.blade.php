<div>
           <!-- Start Feedback Area -->
        <div class="feedback-area pb-100">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                    <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                </div>
                <div class="feedback-slides owl-carousel owl-theme">
                    @foreach($users as $user)
                    <div class="single-feedback-box">
                        <div class="client-info">
                            <div class="d-flex align-items-center">
                                <img src="/storage/{{$user->image}}" alt="{{$this->getTranslate('name',$user,'true')}}">
                                <div class="title">
                                    <h3>{{$this->getTranslate('name',$user,'true')}}</h3>
                                    <span>{{$this->getTranslate('job',$user,'true')}}</span>
                                </div>
                            </div>
                        </div>
                        <p>"{{$this->getTranslate('short_content',$user)}}"</p>
                        <div class="rating d-flex align-items-center justify-content-between">
                            <h5>{{$this->getTranslate('title',$user)}}</h5>
                            <div>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Feedback Area -->

</div>
