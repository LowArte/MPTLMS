@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <c-user-management users="{{$users ?? null}}" usersposts="{{$usersposts ?? null}}"/>
</v-container>

@endsection