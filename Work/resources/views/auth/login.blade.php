@extends('layouts.notregister')

@section('content')
<v-container justify-center>
    <v-card class="pa-5">
        <v-card-title>
            <span class="headline">ВОЙТИ</span>
        </v-card-title>
        @if ($errors->any())
        <v-alert text dense type="error">
            @foreach ($errors->all() as $error)
               <p>{{ $error }}</p>  
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