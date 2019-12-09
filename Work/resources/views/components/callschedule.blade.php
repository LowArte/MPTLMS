@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <callschedule time_table="{{ json_encode($calls) }}"></callschedule>
</v-container>

@endsection