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
            <v-card :elevation="0">
                <v-card-title class="info--text font-weight-light">
                    <h2 class="font-weight-light">Дополнительное образование</h2>
                </v-card-title>
                <v-divider class="ma-2"></v-divider>
                <c-retraining :_user="{{json_encode(auth()->user())}}" :_info="{{json_encode($retraining) ?? null}}" :_printing="{{auth()->user()->post_id}}"></c-retraining>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>
@endsection