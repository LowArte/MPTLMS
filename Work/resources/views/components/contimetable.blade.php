@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
<contimetable discip="{{$discip ?? null}}" call="{{$call ?? null}}" teachers="{{$teachers ?? null}}" place="{{$place ?? null }}" call="{{$call ?? null }}"  departaments="{{$dep ?? null}}"></contimetable>
</v-container>

@endsection