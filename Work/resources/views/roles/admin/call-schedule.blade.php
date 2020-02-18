@extends('layouts.app')

@section('content')
<v-card pa-0 ma-0 :elevation='0'>
    <v-tabs light mobile-break-point="0" grow>
        <v-tab>
            Расписание
        </v-tab>
        <v-tab>
            Конструктор
        </v-tab>
        <v-tab-item>
            <v-container mt-3 fluid grid-list-md text-xs-center pa-0>
                <c-call-schedule :_time_table="{{json_encode($timeTable) ?? null}}"/>
            </v-container>
        </v-tab-item>
        <v-tab-item>
            <v-container mt-3 fluid grid-list-md text-xs-center pa-0>
                <c-bild-call-schedule :_time_table="{{json_encode($timeTable) ?? null}}" 
                                      :_places="{{json_encode($places) ?? null}}"/>
            </v-container>
        </v-tab-item>
    </v-tabs>
</v-card>
@endsection