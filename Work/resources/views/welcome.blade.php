@extends('layouts.notregister')

@section('content')
    <v-layout row wrap>
        <v-flex xs12>
            <v-card :elevation="0">
                <v-card-title class="info--text font-weight-light">
                    <h2 class="font-weight-light text-truncate">Информация для студентов</h2>
                </v-card-title>
                <v-card-text class="pb-0">Начало обучения в автошколе РЭУ им. Г.В.Плеханова с 1 октября 2019 г...</v-card-text>
                <v-card-actions>
                    <v-btn block text light color="pimary" href="/drivingschool">
                        Подробнее об обучении
                        <v-spacer></v-spacer>
                        <v-icon>keyboard_arrow_right</v-icon>
                    </v-btn>
                </v-card-actions>
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
                <c-specialties-list></c-specialties-list>
            </v-card>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card :elevation="0">
                <v-card-title class="info--text font-weight-light">
                    <h2 class="font-weight-light text-truncate">Дополнительное образование</h2>
                </v-card-title>
                <v-divider class="ma-2"></v-divider>
                <c-retraining :_info="{{json_encode($retraining) ?? null}}"></c-retraining>
            </v-card>
        </v-flex>
    </v-layout>
@endsection
