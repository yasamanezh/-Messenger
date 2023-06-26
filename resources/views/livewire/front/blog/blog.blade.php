<div>
    <livewire:front.layout.menu :lang="$multiLanguage">
         <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{__('Blog')}}</h2>
                    <ul>
                        <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>

                        <li>{{__('Blog')}}</li>
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
                <img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="image">
            </div>
        </div>
        <!-- End Page Title Area -->
        <!-- Start Blog Area -->
        <div class="blog-area ptb-100">
            <div class="container">
                <livewire:front.blog.index :blog="[$multiLanguage,$blog]" />
            </div>
        </div>
        <!-- End Blog Area -->
    <livewire:front.layout.footer :language="$multiLanguage">
</div>


