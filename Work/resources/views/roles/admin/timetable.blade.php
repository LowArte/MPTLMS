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
        <v-container fluid grid-list-md text-xs-center>
            <c-panel :_components_prop="{{json_encode($panel_array) ?? null}}"></c-panel>
            <c-timetable :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
                        :_groups_info="{{json_encode($groups_info) ?? null}}" 
                        :_schedule="{{json_encode($schedule) ?? null}}"/>
        </v-container>
    </v-tab-item>
    <v-tab-item>
        <c-bild-timetable :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
                        :_groups_info="{{json_encode($groups_info) ?? null}}" 
                        :_schedule_bild="{{json_encode($schedule_bild) ?? null}}"
                        :_places="{{json_encode($places) ?? null}}"
                        :_disciplines="{{json_encode($disciplines) ?? null}}"
                        :_teachers="{{json_encode($teachers) ?? null}}"/>
    </v-tab-item>
</v-tabs>
@endsection