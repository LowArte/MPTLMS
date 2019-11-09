@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <requestsusers requests="{{json_encode($requests) ?? null}}"></requestsusers>
</v-container>

@endsection