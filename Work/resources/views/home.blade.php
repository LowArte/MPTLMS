@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card :elevation="0">
                <v-card-title class="secondary info--text font-weight-light">
                    <h2 class="font-weight-light text-truncate">Информация для студентов</h2>
                </v-card-title>
                <v-card-text class="px-5">Начало обучения в автошколе РЭУ им. Г.В.Плеханова с 1 октября 2019 г...</v-card-text>
                <panel components_prop="{{$panel_array ?? null}}"></panel>
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

@endsection