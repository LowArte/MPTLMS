@extends('layouts.app')

@section('content')


<v-container fluid grid-list-md text-xs-center>
    <c-panel components_prop="{{json_encode($panel_array) ?? null}}"></c-panel>
    <c-timetable _departaments_info="{{json_encode($departaments_info) ?? null}}" _groups_info="{{json_encode($groups_info) ?? null}}" :schedule="{{json_encode($schedule) ?? null}}"> </c-timetable>
</v-container>
@endsection