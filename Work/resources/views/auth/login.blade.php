@extends('layouts.notregister')

@section('content')
<v-container justify-center class="pt-0 center-block">
    <v-card class="ma-0 pt-5 pa-5 mx-auto" :elevation="0" style="width: 440px">
        <v-img class="mx-auto pt-0" src="{{asset('storage/images/main-logo.png')}}" max-width="192px" height="auto"></v-img>
        <v-card-text class="pa-0 subtitle-1" justify-center text-center centered>
            <center>Один аккаунт. Много возможностей.</center>
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