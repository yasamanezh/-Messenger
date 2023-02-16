<div>
    <ul class="social-links d-flex align-items-center justify-content-center">
        <li><span>{{__('Follow Us On')}}:</span></li>
        @if($social)
        <li><a href="{{$social->instagram}}" target="_blank"><i class="ri-instagram-line"></i></a></li>
        <li><a href="{{$social->twitter}}" target="_blank"><i class="ri-twitter-fill"></i></a></li>
        <li><a href="{{$social->linkdin}}" target="_blank"><i class="ri-linkedin-fill"></i></a></li>
        <li><a href="{{$social->email}}" target="_blank"><i class="ri-messenger-fill"></i></a></li>
        <li><a href="{{$social->github}}" target="_blank"><i class="ri-github-fill"></i></a></li>
        @endif
    </ul>
</div>
