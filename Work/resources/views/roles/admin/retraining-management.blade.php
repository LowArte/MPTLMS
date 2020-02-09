@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-retraining-management :_retraining="{{json_encode($retraining) ?? null}}"
                             _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection
