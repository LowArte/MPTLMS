@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-feedback :_slug="{{auth()->user()->post->slug}}"></c-feedback>
</v-container>
@endsection