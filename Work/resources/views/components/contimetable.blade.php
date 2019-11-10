@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <contimetable place="{{$place ?? null }}" call="{{$call ?? null }}" schedule="{{$schedule ?? null}}" groups ="{{$groups ?? null}}" departaments="{{$dep ?? null}}"></contimetable>
</v-container>

@endsection