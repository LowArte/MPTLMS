<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ config('app.name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <snackbar></snackbar>
        <v-app>
            <v-app-bar app>
                <v-toolbar-title class="text-uppercase">
                    <span class="font-weight-light" dense>
                        {{ config('app.name') }}
                    </span>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                @if (!Auth::check() )
                <v-spacer></v-spacer>
                @if( Route::currentRouteName() != "login")
                <v-btn class="accent" href="{{route("login")}}">ВОЙТИ</v-btn>
                @endif
                @else
                <v-btn color="primary mr-5" text href="{{'\\'.auth()->user()->post->slug}}\home">НАЗАД</v-btn>
                <v-form method="post" action="{{route('logout')}}">
                    @csrf
                    <v-btn block text color="accent" type="submit">ВЫХОД</v-btn>
                </v-form>
                @if (!Auth::check() )
                <v-form method="post" action="{{route('logout')}}">
                    @csrf
                    <v-btn block text color="accent" type="submit">ВЫХОД</v-btn>
                    <v-btn block text color="info" type="submit" href="{{route("password.request")}}">Сменить пароль</v-btn>
                </v-form>
                @endif
                @endif
            </v-app-bar>
            <v-content style="background: white;">
                <v-container fluid grid-list-md text-xs-center>
                    @if ($profilactic ?? false)
                    <v-alert class="my-2" text dense type="warning">
                        <span class="primary--text subtitle-1 ">Ведутся профилактические работы - функциональные возможности системы ограничены. Повторите попытку позднее.</span>
                    </v-alert>
                    @endif
                    @yield('content')
                </v-container>
            </v-content>
        </v-app>
    </div>
    @stack('beforeScripts')
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('afterScripts')
</body>

</html>