@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-requests-users :_requests="{{json_encode($feedback) ?? null}}"
                      _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection