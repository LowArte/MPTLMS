@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <contimetable discip="{{$discip ?? null}}" call="{{$call ?? null}}" schedule="{{$schedule ?? null}}"  teachers="{{$teachers ?? null}}" groups ="{{$groups ?? null}}" place="{{$place ?? null }}" departaments="{{$dep ?? null}}"></contimetable>
</v-container>

@endsection