<div>
      <!-- Start Blog Wrap Area -->
        <div class="blog-area pb-75">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">{{$this->getTranslate('title',$module)}}</span>
                    <h2>{{$this->getTranslate('short_content',$module)}}</h2>
                </div>
                <div class="row justify-content-center">
                    @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-wrap-post">
                            <div class="image">
                                <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}" class="d-block">
                                    <img src="storage/{{$blog->image}}" alt="blog">
                                </a>
                                <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}" class="tag">{{$this->getTranslate('title',$blog->blog)}}</a>
                            </div>
                            <div class="content">
                                <ul class="meta">
                                    <li><i class="ri-time-line"></i> {{$blog->created_at->format('M d , Y')}}</li>
                                    <li><i class="ri-message-2-line"></i> 
                                        <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$blog->slug]) : route('front.post',$blog->slug)}}">
                                            ({{count($blog->comments)}}) Comment</a></li>
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
        <!-- End Blog Wrap Area -->
</div>
