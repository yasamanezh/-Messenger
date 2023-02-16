<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
<livewire:front.layout.head />
        <!-- Scripts -->
       
        @livewireStyles
    </head>
    <body>
               {{$slot}}
        
        @livewireScripts
          <livewire:front.layout.script />
    </body>
</html>
