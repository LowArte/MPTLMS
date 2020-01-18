@extends('layouts.app')

@section('content')
<v-tabs grow>
    <v-tab>
        Расписание
    </v-tab>
    <v-tab>
        Конструктор
    </v-tab>
    <v-tab-item>
        <c-timetable departaments_info="{{json_encode($departaments_info) ?? null}}" 
    _groups_info="{{json_encode($groups_info) ?? null}}" 
    :_schedule="{{json_encode($schedule) ?? null}}"></c-timetable>
    </v-tab-item>
    <v-tab-item>
        <c-bild-timetable departaments_info="{{json_encode($departaments_info) ?? null}}" 
    _groups_info="{{json_encode($groups_info) ?? null}}" 
    :_schedule="{{json_encode($schedule) ?? null}}"></c-bild-timetable>
    </v-tab-item>
</v-tabs>
@endsection