@component('mail::message')
Ответ на обращение от:  {{config('app.name')}}<br>
По ващему обращение связанному с возникшей ошибкой, был отправлен ответ от администратора {{$email}}:<br>
{{$message}}
<br>
Спасибо за ваще обращение
ваш,<br>
{{ config('app.name') }}
@endcomponent
