@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <concallschedule place="{{$place ?? null }}" time="{{$callSch ?? null}}"></concallschedule>
</v-container>

@endsection