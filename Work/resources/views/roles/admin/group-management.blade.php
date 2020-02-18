@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-group-crud :_groups="{{json_encode($groups) ?? null}}" :_departments="{{json_encode($departments) ?? null}}"></c-group-crud>
</v-container>
@endsection