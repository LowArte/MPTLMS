@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-post-management :_posts="{{json_encode($posts) ?? null}}"
                       _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection
