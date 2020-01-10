@extends('layouts.notregister')

@section('content')
<v-container>
    <v-card class="mx-auto" max-width="560">
        <v-card-title>
            <span class="headline">Новый пароль</span>
        </v-card-title>
        @if ($errors->any())
        <v-alert text dense type="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>  
            @endforeach
        </v-alert>
        @endif
        <v-container>
            <v-form action="{{route('password.update')}}" method="post">
                @csrf
                <input type="hidden" name="token" value = "{{$token}}"></input>
                <input type="hidden" name="email" value = "{{$email}}"></input>
                <v-row>
                    <v-col cols="12">
                        <v-text-field name="password"  min="6" type="password" label="Пароль" required ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field name="password_confirmation" min="6" type="password" required label="Повторите пароль"></v-text-field>
                    </v-col>                  
                </v-row>
                <v-card-actions class="pr-1">
                    <div class="flex-grow-1"></div>
                    <v-btn type="submit" text>Изменить</v-btn>
                </v-card-actions>
            </v-form>
        </v-container>   
  </v-card>
</v-container>
@endsection
