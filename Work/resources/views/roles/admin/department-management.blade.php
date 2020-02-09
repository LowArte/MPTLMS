@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <!-- 
    <c-department-management :_departments="{{json_encode($departments) ?? null}}"
                             _slug="{{auth()->user()->post->slug}}"/> 
    -->
    <c-department-management _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection
