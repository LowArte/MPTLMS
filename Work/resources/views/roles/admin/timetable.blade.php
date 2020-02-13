@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-panel :_components_prop="{{json_encode($panel_array) ?? null}}"></c-panel>
    <c-timetable :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
                    :_groups_info="{{json_encode($groups_info) ?? null}}" 
                    :_schedule="{{json_encode($schedule) ?? null}}"
                    :_schedule_bild="{{json_encode($schedule_bild) ?? null}}"
                    :_places="{{json_encode($places) ?? null}}"
                    :_disciplines="{{json_encode($disciplines) ?? null}}"
                    :_teachers="{{json_encode($teachers) ?? null}}"
                    _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection