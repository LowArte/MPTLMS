
<template lang="pug">
  v-container(pa-0 text-center)
    v-row
      v-col.pt-0.pb-0(cols="12")
        v-text-field(name="email" :rules="emailRules"  label="Email" required)
      v-col.pt-0.pb-0(cols="12")
        v-text-field(min="6" label="Пароль" :rules="passwordRules" name="password" type="password" required)
      div(class="flex")
        v-btn(color="accent" href="/" text) Отмена
        v-btn( type="submit" color="blue darken-1" text) ВОЙТИ
      v-btn.mt-2(color="primary font-weight-light" block text height="25" @click="sheet = !sheet")
        small Проблемы со входом
      v-bottom-sheet(v-model="sheet")
        v-sheet.pa-4()
          div.mx-auto
            v-card-title.pa-0.pb-3.font-weight-black Проблемы со входом
            v-card-text.subtitle-1.pa-0.pb-2.font-weight-medium Для обучающегося
            v-card-text.pa-0 Внимание! Для первого входа в личный кабинет необходимо получит пароль в Центре по работе со студентами. В качесте логина используйте Вашу корпоративную почту. После авторизации Вы можете поменять пароль в личном кабинете.
            v-card-text.pa-0 Если выданный центром пароль не подходит - вопользйтесь формой обратной связи, при этом укажите в сообщении вводимые логин и пароль, свои ФИО полностью, дату рождения и группу.
            v-card-text.subtitle-1.pa-0.py-2.font-weight-medium Нет пароля?
            v-card-text.pa-0 Обратитесь в Центр по работе со студентами - Вам выдадут временный пароль для входа в личный кабинет. При себе необходимо иметь студенческий билет.
            v-card-text.subtitle-1.pa-0.py-2.font-weight-medium Забыли пароль?
            a.ma-0.pa-0.pb-2(color="font-weight-light" style="color: #FE532C; text-decoration: none;" href="/password/reset") Восстанвовление пароля на сайте
            v-card-text.pa-0 Либо вы можете обратиться в Центр по работе со студентами или к админестратору сайта (преподавателям)
          v-spacer
          v-btn(class="mt-6 text-center" text color="red" @click="sheet = !sheet") Закрыть
</template>

<script>
export default {
    data() {
        return {
            sheet: false,
            emailRules: [
                v => !!v || "Почта не соответствует требованиям",
                v =>
                /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
                "Не соответствует формату почты"
            ],
            passwordRules: [v => !!v || "Пароль не соответствует требования"]
        };
    }
};
</script>