@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-user-crud :_users="{{json_encode($users) ?? null}}"></c-user-crud>
</v-container>
@endsection