@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card :elevation="0">
                <v-carousel :continuous="false" cycle :show-arrows="false" hide-delimiter-background delimiter-icon="mdi-minus" height="300">
                    <v-carousel-item>
                        <v-sheet height="100%" tile>
                            <v-row class="fill-height" align="center" justify="center">
                                <div class="subtitle">Тут будут  новости техникума</div>
                            </v-row>
                        </v-sheet>
                    </v-carousel-item>
                </v-carousel>
                <v-btn color="info" text block>
                    новости
                </v-btn>
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
                    <h2 class="font-weight-light">Дополнительное образование</h2>
                </v-card-title>
                <v-divider class="ma-2"></v-divider>
                <c-retraining :_user="{{json_encode(auth()->user())}}" :_info="{{json_encode($retraining) ?? null}}"></c-retraining>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>
@endsection