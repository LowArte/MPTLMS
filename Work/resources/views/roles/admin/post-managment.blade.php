@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-post-managment :_posts="{{json_encode($posts) ?? null}}"/>
</v-container>
@endsection
