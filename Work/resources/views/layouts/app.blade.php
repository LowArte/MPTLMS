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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-corner-indicator.min.css" rel="stylesheet">
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
        <v-app-bar color="blue darken-3" dark app clipped-left clipped-right fixed>
            <div :style="$vuetify.breakpoint.smAndUp ? 'width: 300px; min-width: 250px' : 'min-width: 72px'" class="ml-0 pl-3">
                <v-btn icon @click.stop="drawer = !drawer">
                    <v-icon>menu</v-icon>
                </v-btn>
            </div>
            <div class="d-flex align-center" style="margin-left: auto">
                <v-btn light @click="toogleRightDrawer">
                    @{{user.name}}
                </v-btn>
            </div>
        </v-app-bar>
        <v-navigation-drawer fixed v-model="drawerRight" right clipped app>
            <v-card>
                <v-container fluid grid-list-md class="grey lighten-4">
                    <v-layout row wrap>
                        <v-flex xs12>
                            <h3>@{{ user.name }}</h3>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-card-text class="px-0 grey lighten-3">
                    <v-form class="pl-3 pr-1 ma-0">
                        <v-text-field :readonly="!editingUser" label="Email" :value="user.email" ref="email" @input="updateEmail"></v-text-field>
                        <v-text-field :readonly="!editingUser" label="User name" :value="user.name" @input="updateName"></v-text-field>
                        <v-text-field readonly label="Created at" :value="user.created_at" readonly></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :loading="updatingUser" text color="green" @click="updateUser" v-if="editingUser">
                        <v-icon right dark>save</v-icon>
                        Save
                    </v-btn>
                    <v-btn text color="orange" @click="editUser()" v-else>
                        <v-icon right dark>edit</v-icon>
                        Edit
                    </v-btn>
                    <v-btn :loading="logoutLoading" @click="logout" text color="orange">
                        <v-icon right dark>exit_to_app</v-icon>
                        Logout
                    </v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :loading="changingPassword" text color="red" @click="changePassword">Change Password</v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-navigation-drawer>
        <v-content>
            @yield('content')
        </v-content>
    </v-app>
    @stack('beforeScripts')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    @stack('afterScripts')
</body>

</html>