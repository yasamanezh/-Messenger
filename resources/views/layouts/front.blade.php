<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <livewire:front.layout.head />
    @livewireStyles
   </head>

   <body>
        <livewire:front.layout.menu />
        @yield('body')
        <div class="go-top"><i class="ri-arrow-up-s-line"></i></div>
        <livewire:front.layout.footer />
        @livewireScripts
    </body>

</html>