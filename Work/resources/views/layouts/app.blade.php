<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <v-app id="app">
        <snackbar></snackbar>
        <v-navigation-drawer width="300" v-model="leftdrawer" fixed clipped app>
            <c-app-menu _role="{{auth()->user()->post->slug}}"></c-app-menu>
        </v-navigation-drawer>
        <v-app-bar color="primary" dark app clipped-left clipped-right fixed>
            <div :style="$vuetify.breakpoint.smAndUp ? 'width: 300px; min-width: 250px' : 'min-width: 72px'" class="ml-0 pl-3">
                <v-btn icon @click="leftdrawer = !leftdrawer">
                    <v-icon>menu</v-icon>
                </v-btn>
            </div>
            @if(auth()->user()->disabled)
            <div class="d-flex align-center" style="margin-left: auto">
                <v-card-title class="mb-0 pb-0" style="color: #FF3D00;">Вы заблокированы!</v-card-title>
            </div>
            @endif
            <div class="d-flex align-center" style="margin-left: auto">
                <v-btn @click.stop="rightdrawer = !rightdrawer" class="ml-5" light>
                    {{auth()->user()->name}}
                </v-btn>
            </div>
        </v-app-bar>

        <v-navigation-drawer v-model="rightdrawer" fixed right clipped app>
            <v-card outlined style="border: none;" flat>
                <v-form method="post" action="{{route("logout")}}">
                    @csrf
                    <v-btn block text color="accent" type="submit">Выход</v-btn>
                    <v-btn block text color="info" type="submit" href="{{route("password.request")}}">Сменить пароль</v-btn>
                </v-form>
            </v-card>
        </v-navigation-drawer>

        <v-content style="background: white;">
            @yield('content')
        </v-content>
    </v-app>
    @stack('beforeScripts')
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('afterScripts')
</body>

</html>