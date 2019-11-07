@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <callschedule place="{{$place ?? null }}" time="{{$callSch ?? null}}"></callschedule>
</v-container>

@endsection