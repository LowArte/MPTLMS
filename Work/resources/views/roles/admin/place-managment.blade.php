@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-place-managment :_places="{{json_encode($places) ?? null}}"/>
</v-container>
@endsection
