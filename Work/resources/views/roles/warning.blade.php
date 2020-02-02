@extends('layouts.app')

@section('content')
<v-layout row justify-center>
    <v-card :elevation="0" width="320">
        <v-img class="mx-auto" src="{{asset('images/main-logo-non-title.png')}}" max-width="256px" height="auto"></v-img>
        <v-card-title style="color: white;" class="accent">
            Внимание
        </v-card-title>
        <v-card-text style="color: white;" class="pt-3 primary">
            Страница находится в разработке и не доступна в данный момент. Как только раздел будет запущен, система уведомит Вас об этом.
        </v-card-text>
    </v-card>
</v-layout>
@endsection