<div>
    <style>
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #f44761;
            border-color: #f44761;
        }
    </style>
    <div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="row justify-content-center">
            @if($posts)
            @foreach($posts as $post)
            <div class="col-lg-12 col-md-6">
                <div class="single-blog-post">
                    <div class="image">
                        <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$post->slug]) : route('front.post',$post->slug)}}" class="d-block">
                            <img src="/storage/{{$post->image}}" alt="{{$post->title}}">
                        </a>
                        <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$post->slug]) : route('front.post',$post->slug)}}" class="tag">{{$this->getTranslate('title',$post->blog)}}</a>
                    </div>
                    <div class="content">
                        <ul class="meta">
                            <li><i class="ri-time-line"></i> {{$post->created_at->format('M d , Y')}}</li>
                            <li><i class="ri-message-2-line"></i>
                                <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$post->slug]) : route('front.post',$post->slug)}}">
                                    ({{count($post->comments)}}) Comment</a></li>
                        </ul>
                        <h3>
                            <a href="{{$multiLanguage ? route('front.post.language',['language'=>app()->getLocale(),'id'=>$post->slug]) : route('front.post',$post->slug)}}">
                                {{$this->getTranslate('title',$post)}}
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach
            {{$posts->links()}}
            @endif
            
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <aside class="widget-area">
            <div class="widget widget_search">
                <form class="search-form">
                    <label><input type="search" wire:model.debounce.1000="search" class="search-field" placeholder="Search..."></label>
                    <button type="submit"><i class="ri-search-2-line"></i></button>
                </form>
            </div>
         
            <livewire:front.blog.post :lang="$multiLanguage" />
            <livewire:front.blog.category :lang="$multiLanguage" />
            @if($blog)
                 <livewire:front.blog.archive :blog="$blog" />
                 <livewire:front.blog.tag :blog="$blog" />
            @endif    
        </aside>
    </div></div>
</div>
