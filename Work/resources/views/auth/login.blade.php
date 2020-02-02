@extends('layouts.notregister')

@section('content')
<v-container justify-center class="pt-0">
    <v-card class="ma-0 pt-0 pa-5 pb-2 mx-auto" :elevation="0" style="width: 440px">
        <v-img class="mx-auto pt-0" src="{{asset('images/main-logo-non-title.png')}}" max-width="192px" height="auto"></v-img>
        <v-card-text class="pa-0 headline" justify-center text-center centered>
            <center>ВОЙТИ</center>
        </v-card-text>
        @if ($errors->any())
        <v-alert class="my-2" text dense type="error">
            @foreach ($errors->all() as $error)
            <small>{{ $error }}</small>
            @endforeach
        </v-alert>
        @endif
        <v-form action="/login" method="post">
            @csrf
            <c-login></c-login>
        </v-form>
    </v-card>
</v-container>

@endsection