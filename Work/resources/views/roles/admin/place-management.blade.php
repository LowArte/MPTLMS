@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-place-management :_places="{{json_encode($places) ?? null}}"
                        _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection
