@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <c-feedback _slug="{{json_encode($user_slug) ?? null}}"/>
</v-container>

@endsection