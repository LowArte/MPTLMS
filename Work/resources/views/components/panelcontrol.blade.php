@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <panelcontrol options_prop="{{json_encode($options) ?? null}}"></panelcontrol>
</v-container>

@endsection