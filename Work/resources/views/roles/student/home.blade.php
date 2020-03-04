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
                                <div class="subtitle">Тут будут новости техникума</div>
                            </v-row>
                        </v-sheet>
                    </v-carousel-item>
                </v-carousel>
                <v-btn color="primary" text block>
                    новости
                </v-btn>
            </v-card>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card :elevation="0">
                <c-specialties-list></c-specialties-list>
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