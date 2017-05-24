<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <title>{{ config('app.name', 'App') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('stylesheets')

  </head>
  <body>

    <div id="app">
      @yield('content')
    </div>

    <script type='text/javascript'>
      window.USER = {!! auth()->check() ? auth()->user() : "''" !!};

      window.PUSHER_OPTIONS = {
        key: '{{ config('broadcasting.connections.pusher.key') }}'
      }

      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!}
    </script>
    <script src="{{ mix('js/app.js') }}" type='text/javascript'></script>
    @yield('javascripts')

  </body>
</html>
