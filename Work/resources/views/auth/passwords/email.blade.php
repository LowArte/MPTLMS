@extends('layouts.notregister')

@section('content')
<v-container>
    <v-card class="ma-0 pa-2 mx-auto" style="width: 440px">
        <v-card-title>
          <span class="headline">Сброс пароля</span>
        </v-card-title>
        @if ($errors->any())
        <v-alert class="ma-0 mx-2 pa-3" text dense type="error">
            @foreach ($errors->all() as $error)
               <p class="ma-0 pa-0" class="headline">{{ $error }}</p>  
            @endforeach
        </v-alert>
        @endif
        <v-card-text style="color: #FF3D00;">На вашу почту бедет отправлено письмо с подробной инструкцией. Укажите свою почту в поле ниже.</v-card-text>
        <v-form method="post" class="ma-3" action="{{route("password.email")}}">
            @csrf
            <v-text-field label="E-mail" name="email" required></v-text-field>
            <v-card-actions class="text-right">
              <v-btn color="accent" text href="/login">Отмена</v-btn>
              <v-spacer></v-spacer>
              <v-btn type="submit" text> Отправить</v-btn>
            </v-card-actions>
        </v-form>
      </v-card>
</v-container>
@endsection
