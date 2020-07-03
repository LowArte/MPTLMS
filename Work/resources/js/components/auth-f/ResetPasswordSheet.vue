<template lang="pug">
  v-bottom-sheet.pa-3(v-model="sheet" scrollable max-height="300px")
    template(v-slot:activator="{ on }")
      v-btn(text block x-small color="primary font-weight-light" v-on="on") Проблемы со входом?
    v-card.mx-auto(:elevation="0")
      v-card-title.pa-3.font-weight-black Проблемы со входом
      v-card-text
        v-card-text.subtitle-1.pa-0.pb-2.font-weight-medium Для обучающегося
        v-card-text.pa-0 Внимание! Для первого входа в личный кабинет необходимо получит пароль в Центре по работе со студентами. В качесте логина используйте Вашу корпоративную почту. После авторизации Вы можете поменять пароль в личном кабинете.
        v-card-text.pa-0 Если выданный центром пароль не подходит - обратитесь к задеющему отделением или своему куратору.
        v-card-text.subtitle-1.pa-0.py-2.font-weight-medium Нет пароля?
        v-card-text.pa-0 Обратитесь к задеющему отделением или своему куратору - Вам выдадут временный пароль для входа в личный кабинет. При себе необходимо иметь студенческий билет.
        v-card-text.subtitle-1.pa-0.py-2.font-weight-medium Забыли пароль?
        router-link(class='nounderline' to="/password_reset")
          a.ma-0.pa-0.pb-2(color="font-weight-light" style="color: #FE532C; text-decoration: none;") Восстановление пароля на сайте
        v-card-text.pa-0 Либо вы можете обратиться к задеющему отделением или своему куратору или к админестратору сайта (преподавателям)
      v-card-actions
        v-btn(class="mt-6 text-center" text color="red" @click="sheet = !sheet") Закрыть
</template>

<script>
export default {
    data() {
        return {
            sheet: false
        }
    }
}
</script>