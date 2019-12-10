<template lang="pug">
  v-flex.my-2
    v-card.mx-auto(max-width="420px" style="display: flex; flex-direction: column;" height="100%")
      v-img(max-height="200px" v-bind:src="item.href")
      v-card-text.grow
        .my-1.subtitle-1.black--text(style="color: #FF3D00") {{ item.title }}
        .my-1.subtitle-1.black--text ₽ • {{item.cost}}
        .my-4.subtitle-1.black--text Продолжительность • {{item.time}}
        div {{item.text}}
      v-card-actions(wrap)
        v-btn.mx-auto(text small @click="dialog = true") Подать заявку
        v-btn.mx-auto(text small color="accent") Подробнее
    v-dialog(v-model="dialog" width="480")
      v-card
        v-card-title.headline.grey.lighten-3(primary-title) Заявка
        v-card-text
          v-container
            v-row
              v-card-text.py-0(v-show="!visible") Так как вы авторизованный пользователь, Вам необходимо указать только номер телефона, по которому с вами свяжутся сотрудники центра дополнительного образования.
              v-card-text.py-0(v-show="visible") Если у Вас есть учетная запись, Вы можете авторизоваться и данные будут автоматически отправлены в обработку.
              v-card-text.py-0 Программа: {{ item.title }}
              v-col.py-0(cols="12")
                v-text-field(label="Имя" v-model="name" v-show="visible" required)
              v-col.py-0(cols="12")
                v-text-field(label="Фамилия" v-model="secName" v-show="visible" required)
              v-col.py-0(cols="12")
                v-text-field(label="Отчество (при наличии)" v-model="thirdName" v-show="visible")
              v-col.py-0(cols="12")
                v-text-field(label="Email" v-model="email" v-show="visible" required)
              v-col.py-0(cols="12")
                v-text-field(label="Телефонный номер" required)
        v-divider
        v-card-actions
          v-spacer
          v-btn(color="red" text @click="dialog = false") Отмена
          v-btn(color="primary" text @click="dialog = false") Отправить
</template>

<script>
export default {
  data: () => {
    return {
      dialog: false,
      name: user == null ? "" : user.name,
      secName: user == null ? "" : user.secName,
      thirdName: user == null ? "" : user.thirdName,
      email: user == null ? "" : user.email,
      visible: user == null
    };
  },
  props: {
    item: {
      type: Object,
      default: null
    }
  }
};
</script>

<style>
.flexcard {
  display: flex;
  flex-direction: row;
}
</style>