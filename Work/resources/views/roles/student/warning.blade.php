@extends('layouts.app')

@section('content')
    <v-layout row justify-center fill-height>
        <v-card :elevation="0" width="360" class="mt-6">
            <v-img src="{{asset('images/logo512.png')}}" alt="alt"></v-img>
            <v-card-title style="color: white;" class="py-1 accent">
                Внимание
            </v-card-title>
            <v-card-text style="color: white;" class="py-3 primary">
                Страница находится в разработке и не доступна в данный момент. Как только раздел будет запущен, система уведомит Вас об этом.
            </v-card-text>
        </v-card>
    </v-layout>
@endsection