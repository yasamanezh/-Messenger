<div>
    <div class="related-post">
        <h3 class="title">{{__('Related Post')}}</h3>
        <div class="row justify-content-center">
            @foreach($posts as $blog)
            <div class="col-lg-6 col-md-6">
                <div class="single-blog-post">
                    <div class="image">
                        <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}" class="d-block">
                            <img src="/storage/{{$blog->image}}" alt="{{ $this->getTranslate('title',$blog) }}">
                        </a>
                        <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}" class="tag">{{$this->getTranslate('title',$blog->blog)}}</a>
                    </div>
                    <div class="content">
                        <ul class="meta">
                            <li><i class="ri-time-line"></i> {{$blog->created_at->format('M d , Y')}}</li>
                            <li><i class="ri-message-2-line"></i> 
                                <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}">
                                    ({{count($blog->comments)}}) {{__('Comments')}}
                                </a>
                            </li>
                        </ul>
                        <h3>
                        <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}">
                                {{ \Illuminate\Support\Str::limit($this->getTranslate('title',$blog),80,'...') }}
                        </a>
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
