@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-crud _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection
