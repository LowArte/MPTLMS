@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <timetable place="{{$places ?? null }}" call="{{$call ?? null }}" schedule="{{$schedule ?? null}}" groups ="{{$groups ?? null}}" departaments="{{$dep ?? null}}"></timetable>
</v-container>

@endsection