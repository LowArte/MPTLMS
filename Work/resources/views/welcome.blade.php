@extends('layouts.notregister')

@section('content')
<v-layout row wrap>
    <v-flex xs12>
        <v-card :elevation="0" max-width="620px" class="mx-auto mt-4">
            <v-img class="mx-auto" src="{{asset('storage/images/main-logo.svg')}}" max-width="192px" height="auto"></v-img>
            <v-card-text class="pt-3 subtitle-1">
                <center>Московский приборостроительный техникум</center>
                <center>РЭУ имени Г.В. Плеханова</center>
            </v-card-text>
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
@endsection