<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
      
        <livewire:front.layout.head />
           @stack('styles')
    @livewireStyles
   </head>
   <body>
        {{$slot}}
        <div class="go-top"><i class="ri-arrow-up-s-line"></i></div>
        <livewire:front.layout.script />
        @livewireScripts
    </body>
</html>