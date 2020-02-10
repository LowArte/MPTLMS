@extends('layouts.app')

@section('content')

<v-tabs light mobile-break-point="0" grow>
    <v-tab>
        Справка
    </v-tab>
    <v-tab>
        Характеристика
    </v-tab>
    <v-tab-item>
        <c-certificate />
    </v-tab-item>
    <v-tab-item>
        <c-characteristic />
    </v-tab-item>
</v-tabs>
@endsection