<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Styles -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/font-awesome-4.7.0/css/font-awesome.min.css">
  <link href="/css/sweetalert/sweetalert.css" rel="stylesheet">
  <link href="/css/app.css" rel="stylesheet">
  @if(Auth::check() && Auth::user()->isAdmin())
    <link href="/css/muffincms/muffincms.css" rel="stylesheet">
  @endif
  
  @yield('stylesheet')

  <!-- Scripts -->
  <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
  </script>
</head>
<body>
  @yield('content')


  <!-- Scripts -->
  <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="/js/sweetalert/sweetalert.min.js"></script>
  <script src="/js/tinymce/tinymce.min.js"></script>
  <!-- custom script that should be called on layout view only -->
  <script src="/js/app.js"></script>
  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  @if(Auth::check() && Auth::user()->isAdmin())
  <script src="/js/muffincms/muffincms.js"></script>
  <script type="text/javascript">
    // Initialize TinyMCE
    var editor_config = {
      path_absolute : "{{URL::to('/')}}/",
      selector: "textarea",
      force_p_newlines : false,
      force_br_newlines : true,
      convert_newlines_to_brs : false,
      remove_linebreaks : true,
      forced_root_block : false,
      paste_auto_cleanup_on_paste : true,
      paste_postprocess : function(pl, o) {
          // remove &nbsp
          o.node.innerHTML = o.node.innerHTML.replace(/&nbsp;/ig, " ");
      },
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };
    tinymce.init(editor_config);

    $(document).ready(function(){
      $('#img-picker').filemanager('image');
    });
  </script>
  @endif
  

  @yield('script')

</body>
</html>