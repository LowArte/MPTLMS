@extends('layouts.app')

@section('content')

v-container(text-xs-center, grid-list-md, fluid)
  v-row
    v-col(cols='12')
      v-hover(v-slot:default='{ hover }')
        v-card.mx-auto.pa-4(width='max', height='auto', :elevation='hover ? 12 : 2')
          v-card-text.my-1.ma-2.pa-0.display-1.font-weight-black Ваша студенческая карточка
          v-divider.ma-2
          v-container.ma-0.pa-2
            p.font-weight-black.headline.info--text.ma-0 {{$user->name." ".$user->secName." ".$user->thirdName}}
            p.black--text.ma-0
              br
              b Гендерная принадлежность: 
              | {{$student->gender}} 
            p.black--text.ma-0
              br
              b Дата рождения: 
              | {{$student->birthday}}
            v-divider.my-2
            p.black--text.ma-0
              br
              b Email: 
              | {{$user->email}}
            p.black--text.ma-0
              br
              b Специальность: 
              | {{$dep->dep_name_full}}
            p.black--text.ma-0
              br
              b Курс: 
              | {{$group->сurs}}
            p.black--text.ma-0
              br
              b Группа: 
              | {{$group->group_name}}
            p.black--text.ma-0
              br
              b Специализация: 
              | {{$dep->specialization}}
            v-divider.my-2
            p.black--text.ma-0
              br
              b Форма обучения: 
              | {{$group->type_of_study}}
            p.black--text.ma-0
              br
              b Вид финансирования: 
              | {{$student->type_of_financing}}
            p.black--text.ma-0
              br
              b Срок обучения: 
              | {{$group->study_period}}
      v-hover(v-slot:default='{ hover }')
        v-card.mx-auto.my-4.pa-4(width='max', height='auto', :elevation='hover ? 12 : 2')
          v-card-text.my-1.ma-2.pa-0.display-1.font-weight-black Напрвление
          v-divider.my-2
          v-container.ma-0.pa-2
            p.black--text
              | Если у вас есть задолжности, Вы можете самостоятельно скачать и распечатать направление на пересдачу.
            v-btn.my-2.white--text(color='warning')
              | Загрузить
              v-icon(dark, right) cloud_download
          small(style='color: #FF3D00', dark) *на данный момент функция находистя в процессе тестирования

@endsection