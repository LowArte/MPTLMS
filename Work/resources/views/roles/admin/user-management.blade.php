@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-user-crud :_listusers="{{json_encode($users) ?? null}}" :_usersposts="{{json_encode($posts) ?? null}}" _slug="{{auth()->user()->post->slug}}" />
</v-container>
@endsection