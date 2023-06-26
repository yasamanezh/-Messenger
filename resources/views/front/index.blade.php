@extends('layouts.page')
@section('title',__('Languages'))
@section('body')

<div id="gjs">
  <h1>Hello World Component!</h1>
</div>
<div class="panel__top">
    <div class="panel__basic-actions"></div>
</div>
<div class="editor-row">
  <div class="editor-canvas">
    <div id="gjs">...</div>
  </div>
  <div class="panel__right">
    <div class="layers-container"></div>
  </div>
</div>
<div id="blocks"></div>
@push('jsAfterCustomJs')

<script>
   const editor = grapes.init({
        container: '#gjs',
        fromElement: true,
        plugins: ["gjs-blocks-basic", "gjs-plugin-ckeditor",
          editor => gjsForms(editor, { /* options */ }),
          editor => gjsnavbar(editor, { /* options */ }),
          editor => styleFilter(editor, { /* options */ }),
          editor => plugin(editor, { /* options */ }),
          editor => flexbox(editor, { /* options */ }),
          editor => slider(editor, { /* options */ }),
          editor => tabs(editor, { /* options */ }),
          editor => customcode(editor, { /* options */ }),
          editor => tooltip(editor, { /* options */ }),
          editor => gjstouch(editor, { /* options */ }),
          editor => thePlugin(editor, { /* options */ }),
        ],
        pluginsOpts: {
          "gjs-blocks-basic": {
            /* ...options */
          },
          'gjs-plugin-ckeditor': {
            options: {
              language: 'en',
              startupFocus: true,
              extraAllowedContent: '*(*);*{*}', // Allows any class and any inline style
              allowedContent: true, // Disable auto-formatting, class removing, etc.
              enterMode: CKEDITOR.ENTER_BR,
              uiColor: '#0000001a', // Inline editor color
              extraPlugins: 'justify,colorbutton,panelbutton,font,sourcedialog,showblocks',
              toolbar: [
                ["Format", "-", "Bold", "Italic", "Strike", "Underline", "Subscript", "Superscript", "RemoveFormat", "-", "NumberedList", "BulletedList", "-", "Outdent", "Indent", "-", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock", "-", "Link", "Unlink", "Anchor", "TextColor", "BGColor", "-", "ShowBlocks", "-", "Image", "Table", "-", "Sourcedialog"]
              ]
            },
            position: 'left',
          }
        },
        fromElement: false,
        components: LandingPage.components || LandingPage.html,
        style: LandingPage.style || LandingPage.css,
      });

      editor.getConfig().showDevices = 0;

      editor.Panels.addPanel({
        id: "devices-c"
      }).get("buttons").add([{
          id: "set-device-desktop",
          command: function(e) {
            return e.setDevice("Desktop")
          },
          className: "fa fa-desktop",
          active: true
        }, {
          id: "set-device-tablet",
          command: function(e) {
            return e.setDevice("Tablet")
          },
          className: "fa fa-tablet"
        }, {
          id: "set-device-mobile",
          command: function(e) {
            return e.setDevice("Mobile portrait")
          },
          className: "fa fa-mobile"
        },
      ]);

      // Panel should re render again otherwise 
      // New button will not be shown on device panel
      editor.Panels.render();
    });
  }
},
    </script>
    @endpush
@endsection

