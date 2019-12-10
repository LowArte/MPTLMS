@extends('layouts.app')

@section('content')

v-container.fluid.grid-list-md.text-xs-center
    <c-panel components_prop="{{json_encode($panel_array) ?? null}}"></c-panel>
    c-timetable

@endsection