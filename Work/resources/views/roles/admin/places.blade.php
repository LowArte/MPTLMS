@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-places-managment :_places="{{json_encode($places) ?? null}}"></c-user-managment>
</v-container>
@endsection
