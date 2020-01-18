@extends('layouts.notregister')

@section('content')
<v-container justify-center>
    <v-card class="ma-0 pa-5 pb-2 mx-auto" style="width: 440px">
        <v-card-title class="pl-0 pb-0">
            <span class="headline">ВОЙТИ</span>
        </v-card-title>
        @if ($errors->any())
        <v-alert class="my-2" text dense type="error">
            @foreach ($errors->all() as $error)
               <small>{{ $error }}</small>  
            @endforeach
        </v-alert>
        @endif
        <v-form action="/login" method="post" >
            @csrf
            <c-login></c-login>
        </v-form>
    </v-card>
</v-container>

@endsection