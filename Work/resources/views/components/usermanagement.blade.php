@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <usermanagement users="{{$users ?? null}}" usersposts="{{$usersposts ?? null}}"></timetable>
</v-container>

@endsection