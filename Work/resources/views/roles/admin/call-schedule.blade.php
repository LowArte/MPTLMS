@extends('layouts.app')

@section('content')
<v-tabs grow >
    <v-tab>
        Звонки
    </v-tab>
    <v-tab>
        Конструктор
    </v-tab>
    <v-tab-item>
        <c-call-schedule :_time_table="{{json_encode($timeTable) ?? null}}"></c-call-schedule>
    </v-tab-item>
    <v-tab-item>
        <c-bild-call-schedule :_time_table="{{json_encode($timeTable) ?? null}}"></c-bild-call-schedule>
    </v-tab-item>
</v-tabs>
@endsection
