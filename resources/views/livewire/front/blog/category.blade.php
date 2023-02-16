<div class="widget widget_categories">
    <h3 class="widget-title">{{__('Categories')}}</h3>
    <ul>
        @foreach($categories as $category)
        <li>
            <a href="{{$multiLanguage ? route('front.blog.language',['language'=>app()->getLocale(),'id'=>$category->slug]) : route('front.blog',$category->slug)}}">
                {{$this->getTranslate('title',$category)}} 
                <span class="post-count">({{count($category->posts)}})</span>
            </a>
        </li>
        @endforeach
       
    </ul>
</div>