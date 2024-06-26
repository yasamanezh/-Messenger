<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <livewire:front.layout.head />
           <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
         <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    @livewireStyles
   </head>

   <body>
       <!-- Start Profile Authentication Area -->
        <div class="profile-authentication-area">
            
        <livewire:front.layout.banner />
       
        {{$slot}}
          <livewire:front.layout.social />
        </div>
        <livewire:front.layout.script />
          @stack('scripts')
        @livewireScripts
    </body>

</html>