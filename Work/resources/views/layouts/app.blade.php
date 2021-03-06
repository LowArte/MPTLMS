<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/images/main-logo.png" type="image/png">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <v-app id="app">
        <c-layouts class="ma-1" :_is_profilactic="{{json_encode($Profilactic)}}" _name="{{config('app.name', 'Laravel')}}"></c-layouts>
    </v-app>
    @stack('beforeScripts')
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('afterScripts')
</body>

</html>