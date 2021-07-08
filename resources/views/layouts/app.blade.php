<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Laravel')}} | @section('title') @show</title>

  <!-- Styles -->
  <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-flex">
  @include('inc.navbar')

  <div class="container">
    @include('inc.messages')
    @yield('content')    
  </div>

  <div class="flex-grow-1"></div>

  <footer class="footer">
    <p>&copy; <?php echo date("Y"); ?> Photoshow.</p>
  </footer>

  <script src="{{ asset('public/js/app.js') }}"></script>
</body>
</html>