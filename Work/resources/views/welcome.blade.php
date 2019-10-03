<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Личный кабинет</title>
    </head>
    <body>
       <div id="app"> </div>
       <script>
           var BASE_URL = '{{ URL::to('/') }}'
        </script>
        <script src="{{asset('js/app.js')}}" defer></script>
    </body>
</html>
