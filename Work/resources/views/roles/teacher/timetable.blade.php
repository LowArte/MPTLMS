@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-panel :_components_prop="{{json_encode($panel_array) ?? null}}"></c-panel>
    <c-timetable :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
                    :_groups_info="{{json_encode($groups_info) ?? null}}" 
                    :_schedule="{{json_encode($schedule) ?? null}}"/>
</v-container>
@endsection