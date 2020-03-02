@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card :elevation="0">
                <v-card-title class="info--text font-weight-light">
                    <h2 class="font-weight-light">Быстрые действия</h2>
                </v-card-title>
                <c-quick-action></c-quick-action>
            </v-card>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card :elevation="0">
                <v-card-title class="info--text font-weight-light">
                    <h2 class="font-weight-light">Специальности</h2>
                </v-card-title>
                <v-divider class="ma-2"></v-divider>
                <c-specialties-list :_printing="{{auth()->user()->post_id}}"></c-specialties-list>
            </v-card>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card :elevation="0" color="secondary">
                <v-card max-width="620px" class="mx-auto" :elevation="0" color="secondary">
                    <v-card-title class="white--text subtitle-1 black--text text-truncate">
                        Центр допольнительного образования
                    </v-card-title>
                    <v-card-text class="white--text">
                        Московский приборостроительный техникум предоставляет услуги дополнительного образования, с которыми можно ознакомиться на сайте.
                    </v-card-text>
                    <v-card-actions>
                        <v-btn text block color="white" dark href="https://ucmpt.ru/">Перейти на сайт</v-btn>
                    </v-card-actions>
                </v-card>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>
@endsection