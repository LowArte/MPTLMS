@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-place-crud :_places="{{json_encode($places) ?? null}}"></c-place-crud>
</v-container>
@endsection