@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-panel-control :_options="{{json_encode($options) ?? null}}"></c-panel-control>
</v-container>
@endsection
