@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-department-management :_departments="{{json_encode($departments) ?? null}}"/>
</v-container>
@endsection
