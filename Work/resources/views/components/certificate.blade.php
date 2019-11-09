@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <certificate info="{{json_encode($info) ?? null}}"></certificate>
</v-container>

@endsection