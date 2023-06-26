<div>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! app('seotools')->generate() !!}
    <link  rel="icon"  type="image/png" sizes="32x32"  href="/storage/{{$setting->icon}}">
    <!-- Link of CSS files -->
    @if($dir == 'rtl')
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/odometer.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/rtl/assets/css/style.css')}}">

    @else
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/odometer.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/ltr/assets/css/style.css')}}">
    @endif

</div>
