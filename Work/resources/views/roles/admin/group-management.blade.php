@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-group-management :_groups="{{json_encode($groups) ?? null}}" 
                        :_departments="{{json_encode($departments) ?? null}}"
                        _slug="{{auth()->user()->post->slug}}"/>
</v-container>
@endsection
