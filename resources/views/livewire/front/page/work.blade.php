<div>
    
    @if($page)
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{$this->getTranslate('title',$page)}}</h2>
                    <ul>
                        <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>
                        <li>{{$this->getTranslate('title',$page)}}</li>
                    </ul>
                </div>
            </div>
            <div class="divider"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="banner-shape1">
                <img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="{{$this->getTranslate('title',$page)}}">
            </div>
        </div> 
          <!-- Start How It Works Area -->
        <div class="how-it-works-area ptb-100">
            <div class="container">
                @foreach($steps as $key=>$step)
                <div class="how-it-works-content">
                    <div class="number">{{$key+1}}</div>
                    <div class="row m-0">
                        <div class="col-lg-3 col-md-12 p-0">
                            <div class="box">
                                <h3>{{$this->getTranslate('title',$step)}}</h3>
                                <span>{{$this->getTranslate('short_content',$step)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12 p-0">
                            <div class="content">
                                {!! $this->getTranslate('content',$step) !!}
                                <img src="/storage/{{$step->image}}" alt="{{$this->getTranslate('title',$step)}}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <!-- End How It Works Area -->
           <livewire:front.module.download1 />
               <livewire:front.layout.footer :language="$multiLanguage">

@endif

</div>