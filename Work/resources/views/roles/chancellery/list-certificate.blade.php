@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-list-certificate :_requests="{{json_encode($requests) ?? null}}"
                        _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection
