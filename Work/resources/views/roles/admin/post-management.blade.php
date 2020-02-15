@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-post-crud :_post="{{json_encode($posts) ?? null}}"></c-post-crud>
</v-container>
@endsection