<div>
     <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{$this->getTranslate('title',$post)}}</h2>
                    <ul>
                        <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>
                        <li>{{$this->getTranslate('title',$post)}}</li>
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
            <div class="banner-shape1"><img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="{{$this->getTranslate('title',$post)}}"></div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Blog Details Area -->
        <div class="blog-details-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="blog-details-desc">
                            <div class="article-image">
                                <a href="blog-grid.html" class="tag">{{$this->getTranslate('title',$post->blog)}}</a>
                                <img src="/storage/{{$post->image}}" alt="{{$this->getTranslate('title',$post->blog)}}">
                            </div>
                            <div class="article-content">
                                <div class="entry-meta">
                                    <h4>{{$this->getTranslate('title',$post)}}</h4>
                                    <ul>
                                        <li><i class="ri-calendar-2-line"></i> {{$post->created_at->format('M d , Y')}}</li>
                                        <li><i class="ri-message-2-line"></i><a href="">({{count($post->comments)}}) {{__('Comments')}}</a></li>
                                    </ul>
                                </div>
                                {!! $this->getTranslate('content',$post) !!} 
                            </div>
                            <div class="article-footer">
                                <div class="post-author-meta">
                                    <div class="d-flex align-items-center">
                                        <img src="@if($post->user->profile_photo_path)  /storage/{{$post->user->profile_photo_path }} @else {{asset('admin/img/svgs/user.svg')}} @endif" alt="{{$post->user->name }}">
                                        <div class="title">
                                            <span class="name">
                                                <a href="">{{$post->user ? $post->user->name : 'admin'}}</a></span>
                                            <span class="date">{{$post->created_at->format('M d , Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                           <livewire:front.post.layout.related :post="[$multiLanguage,$post]"/>
                           <livewire:front.post.layout.comment :post="$post" />
                         
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <aside class="widget-area">
                            <livewire:front.blog.post :lang="$multiLanguage" />
                            <livewire:front.blog.category :lang="$multiLanguage" />
                            <livewire:front.post.layout.archive :post="$post" />
                            <livewire:front.post.layout.tag :post="$post" />
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog Details Area -->

    <livewire:front.module.download1 />
    <livewire:front.layout.footer :language="$multiLanguage">

</div>
