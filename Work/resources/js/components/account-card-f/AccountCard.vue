<template lang="pug">
v-content.pa-0
    v-alert.my-2(text dense type="warning")
        span.subtitle-1(primary--text) Данный раздел может содержать ошибки, так как находится в процесссе разработки. Если найдёте какие-либо ошибки, сообщите нам. Спасибо!
    v-layout.row.wrap
        v-flex
            v-card.mx-auto
                v-list-item(two-line)
                    v-list-item-avatar(color="grey darken-3")
                    v-list-item-content
                        v-list-item-title.headline {{name}}
                        v-list-item-subtitle Должность: {{post}}
                v-divider
                v-card-text.pb-2.font-weight-bold Дата рождения: 01.01.2000
                v-card-text.py-2.font-weight-bold Гендерный признак: Мужчина/Женщина
                v-card-text.py-2.font-weight-bold E-mail: now@mpt.ru
                v-card-text.py-2.font-weight-bold Специальность: 09.02.03 Программирование в компьютерных системах
                v-card-text.py-2.font-weight-bold Группа: п-х-хх
                v-card-text.py-2.font-weight-bold Текущий курс
                v-slider.mx-4(v-model="cours" :max="3" :tick-labels="labels"  disabled)
                v-card-actions
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(text light v-on="on" color="accent")
                                v-icon warning
                                span.ma-2 Сообщить об ошибке
                        span Сообщить об ошибке
                    v-spacer
                    v-btn(icon @click="show = !show")
                        v-icon {{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                v-expand-transition
                    div(v-show="show")
                        v-divider
                        v-card-text.py-2 Специализация: Техник-программист
                        v-card-text.py-2 Форма обучения: Очная
                        v-card-text.py-2 Вид финансирования: Бюджет/Платный
                        v-card-text.py-2 Срок обучения: 3г 10м
        v-flex
            v-card.mx-auto
                v-card-title Уведомления
                v-divider
                v-card-text Тут будут уведомления
                v-divider
                v-card-actions
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn.my-2(icon light v-on="on" color="success")
                                v-icon mdi-check-all
                        span Отметить все прочитанными
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(text light v-on="on" color="accent")
                                v-icon mdi-notification-clear-all
                                span.ma-2 Очистить
                        span Очистить уведомления
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(icon light v-on="on" color="pimary")
                                v-icon more_horiz
                        span Подробнее
    v-layout.row.wrap
        v-flex
            v-card.mx-auto
                v-card-title Направления
                v-divider
                v-card-text Нет открытых направлений
                v-divider
                v-card-actions
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn.my-2(icon light v-on="on" color="success")
                                v-icon mdi-download
                        span Скачать доступный направления
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(text light v-on="on" color="pimary")
                                v-icon mdi-printer
                                span.ma-2 Печать
                        span Напечатать доступный направления
    v-layout.row.wrap
        v-flex
            v-card
                v-card-title Успеваемость
                v-card-text Средний бал
                    div.text-center.ma-3
                        p.text-center.display-1.ma-0 {{rating}}
                v-card-text Данный показатель говорит о Вашей успеваемости. Значение является усредненным из общего кол-ва оценок. Если показатель слишком мал, Вам стоит обратить внимание на свои оценки.
                v-divider
                v-card-actions
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(icon light v-on="on" color="pimary")
                                v-icon more_horiz
                        span Подробнее
        v-flex
            v-card
                v-card-title Посещаемость
                v-card-text Кол-во пропущенных часов
                    div.text-center.ma-3
                        p.text-center.display-1.ma-0 {{hours}}
                v-card-text Данный показатель указывает на кол-во часов пропущенных за семестр. Если у Вас более 70% пропущенных занятий, то Вам следует обратиться к педагогу организатору вашего отделения.
                v-divider
                v-card-actions
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(icon light v-on="on" color="pimary")
                                v-icon more_horiz
                        span Подробнее
    v-layout.row.wrap
        v-flex
            v-card
                v-card-title Преподаватели
                v-divider
                v-card-text Тут ещё нет преподавателей
                v-divider
                v-card-actions
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(block text light v-on="on" color="pimary") Показать всех
                        span Показать всех
        v-flex
            v-card
                v-card-title Ваши одногруппники
                v-divider
                v-card-text Тут ещё никого нет
                v-divider
                v-card-actions
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(block text light v-on="on" color="pimary") Показать всех
                        span Показать всех
    v-layout.row.wrap
        v-flex
            v-card
                v-card-title Услуги
                v-divider
                v-card-text.body-1 Услуги по заказу справок и характеристик для организаций/военных комиссариатов
                v-card-actions
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(block text light v-on="on" color="pimary") Получить
                                v-spacer
                                v-icon keyboard_arrow_right
                        span Справки об обучение в МПТ, характеристик в военный комиссариат.
                v-card-text.body-1 Услуги по оформлению дополнительных выплат к ситипендии в виде материальной помощи многодетным семьям или пособия по инвалидности. 
                v-card-actions
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(block text light v-on="on" color="pimary") Получить
                                v-spacer
                                v-icon keyboard_arrow_right
                        span Заявление на получение материальной помощи или пособия по инвалидности.
                v-card-text.body-1 Психологическая помощь студентам.
                v-card-actions
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(block text light v-on="on" color="pimary") Получить
                                v-spacer
                                v-icon keyboard_arrow_right
                        span Записаться на прием к психологу.
</template>

<script>
export default {
  data() {
    return {
        name: "Фамилия Имя Отчество",
        post: "Наименование должности",
        cours: 2,
        labels: ['1', '2', '3', '4'],
        show: false,
        rating: 4.3,
        hours: 28
    };
  }
};
</script>
