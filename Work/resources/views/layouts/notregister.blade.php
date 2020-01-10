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
                <v-toolbar-title class="headline text-uppercase">
                    <span class="font-weight-light">{{ config('app.name') }}</span>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                @if ($profilactic ?? false)
                    <v-card-title class="mb-0 pb-0" style="color: #FF3D00;">Включён режим профилактики!</v-card-title>
                @endif
                @if (!Auth::check() )
                    <v-spacer></v-spacer>
                    @if( Route::currentRouteName() != "login")
                        <v-btn href="{{route("login")}}">Войти</v-btn>
                    @endif
                @else
                    <v-btn color="accent mr-5" dark href="{{'\\'.auth()->user()->post->slug}}\home">ВОЙТИ</v-btn>
                    <v-form method="post" action="{{route('logout')}}">
                        @csrf
                        <v-btn type="submit" color="accent" dark>ВЫЙТИ</v-btn>
                    </v-form>
                @endif
            </v-app-bar>
            <v-content style="background: white;">
                <v-container fluid grid-list-md text-xs-center>
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