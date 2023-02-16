 <div class="widget widget_pakap_posts_thumb">
        
        <h3 class="widget-title">{{__('Popular Posts')}} </h3>
        @foreach($posts as $blog)
        <article class="item">
            <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}" class="thumb">
                <span class="fullimage cover bg1" role="img" style="    background-image: url(/storage/{{$blog->image}}) !important;"></span>
            </a>
            <div class="info">
                <h4 class="title usmall">
                    <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}">
                        {{$this->getTranslate('title',$blog)}}
                    </a>
                </h4>
                <span class="date"><i class="ri-calendar-2-fill"></i> {{$blog->created_at->format('M d , Y')}}</span>
            </div>
        </article>
        @endforeach
    </div>

