@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-department-managment :_departments="{{json_encode($departments) ?? null}}"></c-department-managment>
</v-container>
@endsection