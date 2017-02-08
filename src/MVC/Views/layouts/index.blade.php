<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  @yield('meta')

  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="/css/font-awesome-4.7.0/css/font-awesome.min.css">
  <link href="/css/sweetalert/sweetalert.css" rel="stylesheet">
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
  <script src="/js/app.js"></script>
  <!-- <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
  <script src="/js/sweetalert/sweetalert.min.js"></script>
  <!-- custom script that should be called on layout view only -->
  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  @if(Auth::check() && Auth::user()->isAdmin())
  <script src="/js/muffincms/muffincms.js"></script>
  @endif

  @yield('script')
</body>
</html>