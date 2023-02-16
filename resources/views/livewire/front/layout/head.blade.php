<div>
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
   
    <link rel="icon" href="/storage/{{$setting->icon}}">
</div>
