<template lang="pug">
  v-flex.my-2
      v-card.mx-auto(max-width="420px" style="display: flex; flex-direction: column;" height="100%")
        v-img(max-height="200px" v-bind:src="item.href")
        v-card-text.grow
          .my-1.subtitle-1.black--text(style="color: #FF3D00") {{item.title}}
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
                v-col.py-0(cols="12")
                  v-text-field(label="Имя" required)
                v-col.py-0(cols="12")
                  v-text-field(label="Фамилия" required)
                v-col.py-0(cols="12")
                  v-text-field(label="Отчество (при наличии)")
                v-col.py-0(cols="12")
                  v-text-field(label="Email" required)
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
      dialog: false
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