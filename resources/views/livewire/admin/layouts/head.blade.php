<div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>@yield('title')</title>

    <!-- Bootstrap css-->
    <link href="{{asset('admin/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- Icons css-->
    <link href="{{asset('admin/plugins/web-fonts/icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('admin/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/web-fonts/plugin.css')}}" rel="stylesheet"/>

    <!-- Style css-->
    <link href="{{asset('admin/css/style/style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/colors/default.css')}}" rel="stylesheet">
    
    <!-- Internal Summernote css-->
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">


    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('admin/css/colors/color.css')}}">

  
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
    
   <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
     <!-- Internal Summernote js-->
    <script  src="{{asset('admin/plugins/summernote/summernote-bs4.js')}}"></script>

    <script >
       // Define function to open filemanager window
        var lfm = function (options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/admin/laravel-filemanager';
            window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
        };

        // Define LFM summernote button
        var LFMButton = function (context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function () {

                    lfm({type: 'image', prefix: '/admin/laravel-filemanager'}, function (lfmItems, path) {
                        lfmItems.forEach(function (lfmItem) {
                            context.invoke('insertImage', lfmItem.url);
                        });
                    });

                }
            });
            return button.render();
        };
    </script>
</div>
