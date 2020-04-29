<template lang="pug">
v-content.pa-0(v-if="user")
    v-alert.my-2(border="left" dense type="warning")
        span.subtitle-1(primary--text) Данный раздел может содержать ошибки, так как находится в процесссе разработки. Если найдёте какие-либо ошибки, сообщите нам. Спасибо!
    v-layout.row.wrap
        v-flex
            v-card.mx-auto
                v-list-item(two-line)
                    v-list-item-avatar(color="grey darken-3")
                    v-list-item-content
                        v-list-item-title.headline {{user.secName + " " + user.name + " " + user.thirdName}}
                        v-list-item-subtitle Должность: {{user.post.name}}
                v-divider
                v-card-text.pb-2.font-weight-bold Дата рождения: {{user.student.birthday}}
                v-card-text.py-2.font-weight-bold Гендерный признак: {{user.student.gender}}
                v-card-text.py-2.font-weight-bold E-mail: {{user.email}}
                v-card-text.py-2.font-weight-bold Специальность: 09.02.03 Программирование в компьютерных системах
                v-card-text.py-2.font-weight-bold Группа: {{user.student.group.group_name}}
                v-card-text.py-2.font-weight-bold Текущий курс
                v-slider.mx-4(v-model="curs" :max="3" :tick-labels="labels"  disabled)
                v-card-actions
                    span.ma-2 Дополнительная информация
                    v-spacer
                    v-btn(icon @click="show = !show")
                        v-icon {{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                v-expand-transition
                    div(v-show="show")
                        v-divider
                        v-card-text.py-2 Специализация: {{user.student.group.department.qualification}}
                        v-card-text.py-2 Форма обучения: Очная
                        v-card-text.py-2 Вид финансирования: {{user.student.type_of_financing}}
                        v-card-text.py-2 Срок обучения: {{user.student.group.department.studysperiod}}
                        v-card-actions
                            v-tooltip(bottom)
                                template(v-slot:activator="{ on }")
                                    router-link(class='nounderline' :to="'feedback'") 
                                        v-btn(text light v-on="on" color="accent")
                                            v-icon warning
                                            span.ma-2 Сообщить об ошибке
                                span Сообщить об ошибке

        v-flex
            v-card.mx-auto
                v-system-bar(color="pimary")
                    small Уведомления
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
            v-card
                v-system-bar(color="pimary")
                    small Услуги
                v-card-text.body-1 Услуги по заказу справок и характеристик для организаций/военных комиссариатов
                v-card-actions
                    router-link(class='nounderline' :to="'/' + user.post.slug + '/certificate'")
                        v-tooltip(bottom)
                            template(v-slot:activator="{ on }")
                                v-btn(block text light v-on="on" color="pimary") Получить
                                    v-spacer
                                    v-icon keyboard_arrow_right
                            span Справки об обучение в МПТ, характеристик в военный комиссариат
                v-card-text.body-1 Психологическая помощь студентам
                v-card-actions
                    router-link(class='nounderline' :to="'/' + user.post.slug + '/psychologicalcounseling'")
                        v-tooltip(bottom)
                            template(v-slot:activator="{ on }")
                                v-btn(block text light v-on="on" color="pimary") Получить
                                    v-spacer
                                    v-icon keyboard_arrow_right
                            span Записаться на прием к психологу
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  computed: {
    ...mapGetters(["user"])
  },
  data() {
    return {
        post: "Студент",
        curs: 2,
        labels: ["1", "2", "3", "4"],
        show: false,
        rating: 4.3,
        hours: 28
    };
  },

  beforeMount(){
      this.curs = this.user.student.curs; 
  }
};
</script>