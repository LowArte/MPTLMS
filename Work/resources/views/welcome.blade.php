<?php
use App\Models\SiteOptions;
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <snackbar></snackbar>
        <v-app v-cloak>
            <v-app-bar app>
                <v-toolbar-title class="headline text-uppercase">
                    <span class="font-weight-light">Личный кабинет</span>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                @if (SiteOptions::get()[0]->option_value == 1)
                    <v-card-title class="mb-0 pb-0" style="color: #FF3D00;">Включён режим профилактики!</v-card-title>
                @endif
                @if (Route::has('login') && ! Auth::check() )
                    <v-spacer></v-spacer>
                    <login-button action="{{ $action ?? null }}"></login-button>
                    <remember-password action="{{ $action ?? null }}"></remember-password>
                    <reset-password action="{{ $action ?? null}}" token="{{$token ?? null}}" email="{{$email ?? null}}"></reset-password>
                @else
                    <v-btn color="primary mr-5" dark href="\home">ВОЙТИ</v-btn>
                    <v-btn color="accent" dark @click="logout">ВЫЙТИ</v-btn>
                @endif
            </v-app-bar>
            <v-content>
                <v-container fluid grid-list-md text-xs-center>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-card :elevation="0">
                                <v-card-title class="secondary info--text font-weight-light">
                                    <h2 class="font-weight-light text-truncate">Информация для студентов</h2>
                                </v-card-title>
                                <v-card-text class="px-5">Начало обучения в автошколе РЭУ им. Г.В.Плеханова с 1 октября 2019 г...</v-card-text>
                                <panel :elevation="1" components_prop="{{$panel_array ?? null}}"></panel>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-card :elevation="0">
                                <v-card-title class="secondary info--text font-weight-light">
                                    <h2 class="font-weight-light">Специальности</h2>
                                </v-card-title>
                                <v-divider class="ma-2"></v-divider>
                                <subtitle></subtitle>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-card :elevation="0">
                                <v-card-title class="secondary info--text font-weight-light">
                                    <h2 class="font-weight-light">Дополнительное образование</h2>
                                </v-card-title>
                                <v-divider class="ma-2"></v-divider>
                                <retraining></retraining>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
        </v-app>
    </div>
    <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
</body>

</html>