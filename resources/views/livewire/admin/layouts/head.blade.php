<div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Bootstrap css-->
    <link href="{{asset('admin/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- Icons css-->
    <link href="{{asset('admin/plugins/web-fonts/icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('admin/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/web-fonts/plugin.css')}}" rel="stylesheet"/>

    <!-- Style css-->
    <link href="{{asset('admin/css/style/style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/skins.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/dark-style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/colors/default.css')}}" rel="stylesheet">

    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('admin/css/colors/color.css')}}">

    <!-- Select2 css -->
    <link href="{{asset('admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <!-- Internal Quill css-->
   
    <style>
        .overflow-x-hidden{
            overflow-x: hidden !important;
        }
    </style>

    <!-- Sidemenu css-->
    <link href="{{asset('admin/css/sidemenu/sidemenu.css')}}" rel="stylesheet">
 
    <!-- custom css-->
    @stack('customcss')

    <livewire:styles/>
    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}" defer></script>
</div>
