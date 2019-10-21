@extends('layouts.app')

@section('content')

    <v-container fluid grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card>
                    <v-card-title class="secondary info--text font-weight-light"><h2 class="font-weight-light">Главная</h2></v-card-title>
                    <panel components_prop = "{{$panel_array ?? null}}"></panel>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>

@endsection
