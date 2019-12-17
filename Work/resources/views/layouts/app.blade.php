<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ Auth::user() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <v-app id="app" v-cloak>
        <snackbar></snackbar>
        <v-navigation-drawer fixed clipped app v-model="drawer">
            <v-list dense>
                <template v-for="(item, i) in items">
                    <template v-if="checkRoles(item)">
                        <v-layout row v-if="item.heading" align-center :key="i">
                            <v-flex xs6>
                                <v-subheader v-if="item.heading">
                                    @{{ item.heading }}
                                </v-subheader>
                            </v-flex>
                        </v-layout>
                        <v-list-group v-else-if="item.children" v-model="item.model" no-action>
                            <v-list-item slot="item" @click="menuItemSelected(item)">
                                <v-list-item-action>
                                    <v-icon>@{{ item.model ? item.icon : item['icon-alt'] }}</v-icon>
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        @{{ item.text }}
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item v-for="(child, i) in item.children" :key="i" @click="menuItemSelected(child)">
                                <v-list-item-action v-if="child.icon">
                                    <v-icon>@{{ child.icon }}</v-icon>
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        @{{ child.text }}
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-group>
                        <v-list-item v-else @click="menuItemSelected(item)">
                            <v-list-item-action>
                                <v-icon>@{{ item.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>
                                    @{{ item.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar color="primary" dark app clipped-left clipped-right fixed>
            <div :style="$vuetify.breakpoint.smAndUp ? 'width: 300px; min-width: 250px' : 'min-width: 72px'" class="ml-0 pl-3">
                <v-btn icon @click.stop="drawer = !drawer">
                    <v-icon>menu</v-icon>
                </v-btn>
            </div>
            <div class="d-flex align-center" style="margin-left: auto">
                <c-notifications _messages="{{json_encode(Auth::user()->unreadNotifications)}} "></c-notifications>
                <v-btn class="ml-5" light @click="toogleRightDrawer">
                    @{{user.name}}
                </v-btn>
            </div>
        </v-app-bar>
        <v-navigation-drawer fixed v-model="drawerRight" right clipped app>
            <v-card outlined style="border: none;" flat>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :loading="logoutLoading" @click="logout" text color="accent">
                        <v-icon right dark>exit_to_app</v-icon>
                        Выход
                    </v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :loading="changingPassword" text color="accent" @click="changePassword">Смена пароля</v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-navigation-drawer>
        <v-content style="background: white;">
            @yield('content')
        </v-content>
    </v-app>
    @stack('beforeScripts')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    @stack('afterScripts')
</body>

</html>