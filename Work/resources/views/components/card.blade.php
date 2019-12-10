@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <v-row>
        <v-col cols="12">
            <v-hover v-slot:default="{ hover }">
                <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-4" height="auto" width="max">
                    <v-card-text class="my-1 ma-2 pa-0 display-1 font-weight-black">Ваша студенческая карточка</v-card-text>
                    <v-divider class="ma-2"></v-divider>
                    <v-container class="ma-0 pa-2">
                        <p class="font-weight-black headline ma-0" style="color: #FF3D00;">{{$user->name." ".$user->secName." ".$user->thirdName}}</p>
                        <p class="black--text ma-0"><br><b>Гендерная принадлежность: </b>{{$student->gender}}</p>
                        <p class="black--text ma-0"><br><b>Дата рождения: </b>{{$student->birthday}}</p>
                        <v-divider class="mt-2"></v-divider>
                        <p class="black--text ma-0"><br><b>Email: </b>{{$user->email}}</p>
                        <p class="black--text ma-0"><br><b>Специальность: </b>{{$dep->dep_name_full}}</p>
                        <p class="black--text ma-0"><br><b>Курс: </b>{{$group->сurs}}</p>
                        <p class="black--text ma-0"><br><b>Группа: </b>{{$group->group_name}}</p>
                        <p class="black--text ma-0"><br><b>Специализация: </b>{{$dep->specialization}}</p>
                        <v-divider class="mt-2"></v-divider>
                        <p class="black--text ma-0"><br><b>Форма обучения: </b>{{$group->type_of_study}}</p>
                        <p class="black--text ma-0"><br><b>Вид финансирования: </b>{{$student->type_of_financing}}</p>
                        <p class="black--text ma-0"><br><b>Срок обучения: </b>{{$group->study_period}}</p>
                    </v-container>
                </v-card>
            </v-hover>
            <v-hover v-slot:default="{ hover }">
                <v-card :elevation="hover ? 12 : 2" class="mx-auto my-4 pa-4" height="auto" width="max">
                    <v-card-text class="my-1 ma-2 pa-0 display-1 font-weight-black">Напрвление</v-card-text>
                    <v-divider class="ma-2"></v-divider>
                    <v-container class="ma-0 pa-2">
                        <p class="black--text">Если у вас есть задолжности, Вы можете самостоятельно скачать и распечатать направление на пересдачу.</p>
                        <v-btn color="warning" class="my-2 white--text">
                            Загрузить
                            <v-icon right dark>cloud_download</v-icon>
                        </v-btn>
                    </v-container>
                    <small dark style="color: #FF3D00">*на данный момент функция находистя в процессе тестирования</small>
                </v-card>
            </v-hover>
        </v-col>
    </v-row>
</v-container>

@endsection