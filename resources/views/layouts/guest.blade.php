<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <livewire:front.layout.head />
           <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
   </head>

   <body>
       <!-- Start Profile Authentication Area -->
        <div class="profile-authentication-area">
            
        <livewire:front.layout.banner />
       
        {{$slot}}
          <livewire:front.layout.social />
        </div>
        <livewire:front.layout.footer />
        @livewireScripts
    </body>

</html>