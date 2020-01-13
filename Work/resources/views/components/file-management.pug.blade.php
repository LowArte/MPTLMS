@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <c-file-management _files="{{$files ?? null}}"/>
</v-container>

@endsection