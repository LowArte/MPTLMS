@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <v-layout row wrap>
        <v-card mx-auto pa-3 height='auto' width='100%'>
            <v-card-text my-2 ma-0 pa-0 class="title"> Панель управления </v-card-text>
            <v-divider></v-divider>
            <c-panel-control :_options="{{json_encode($options) ?? null}}" _slug="{{auth()->user()->post->slug}}"></c-panel-control>
        </v-card>
    </v-layout>
</v-container>
@endsection