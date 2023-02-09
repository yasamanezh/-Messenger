<div>
    @if(count($tags) >=2)
<div class="widget widget_tag_cloud">
 
    <h3 class="widget-title">{{__('messages.Tags')}}</h3>
    <div class="tagcloud">
        @foreach($tags as $tag)
        <a href="blog-right-sidebar.html">{{$tag}}</a>
        @endforeach
    </div>
</div>
    @endif 
</div> 


