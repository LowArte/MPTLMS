@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-user-management :_listusers="{{json_encode($users) ?? null}}" :_arrusersposts="{{json_encode($posts) ?? null}}"/>
</v-container>
@endsection
