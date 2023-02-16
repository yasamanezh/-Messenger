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
  
    {!! $this->getTranslate('content', $page) !!}
    @if($page->use_app_module)
      <livewire:front.module.download1 />
    @endif
        <livewire:front.layout.footer :language="$multiLanguage">
    @endif
</div>
