@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-requests-users _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection