@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <v-tabs grow >
        <v-tab>
            Рассписание
          </v-tab>
          <v-tab>
            Конструктор рассписания
          </v-tab>
        <v-tab-item>
            <c-timetable></c-timetable>
        </v-tab-item>
        <v-tab-item>
            <c-bild-timetable></c-bild-timetable>
        </v-tab-item>
    </v-tabs>
</v-container>
@endsection
