@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <c-call-schedule _time_table="{{ json_encode($calls) }}"/>
</v-container>

@endsection