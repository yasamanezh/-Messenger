<div> 
    @if($archives)
<div class="widget widget_archive">
   
    <h3 class="widget-title">{{__('Archives')}}</h3>
    <ul>
        @foreach($archives as $archive)
        <li><a href="">{{$archive}}</a></li>
        @endforeach
    </ul>
   
</div>
    @endif
</div>
