<div>
    @if($module)
      <!-- Start App About Area -->
        <div class="app-about-area pb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="app-about-image">
                            <img src="{{$url}}/storage/{{$module->file1}}" alt="{{$this->getTranslate('title',$module)}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="app-about-content">
                            <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                            <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                            {!! $this->getTranslate('content',$module)!!}
                            <div class="btn-box">
                               <a href="{{$this->getUrl($setting->free_trial)}}" class="default-btn">{{__('Start Free Trial')}}</a>
                               <a href="{{$this->getUrl($module->more_link)}}" class="link-btn">{{$this->getTranslate('more_text',$module,'true')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End App About Area -->
@endif
</div>

     