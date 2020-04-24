<template lang="pug">
v-card-actions
    v-dialog(v-model="dialog" persistent max-width="600px")
        template(v-slot:activator="{ on }")
            v-btn(text block color="accent" v-on="on") Ответить
        v-card
            v-system-bar
                small Ответ на обращения пользователя
            v-form(ref="form" @submit.prevent="submit")
                v-textarea.ma-2(outlined v-model="text" :rules="textRules" label="Напишите ответ пользователю")
                v-card-actions
                    v-btn(color="blue darken-1" text @click="dialog = false") Отменить
                    v-spacer
                    v-btn(color="accent darken-1" text @click="dialog = false" type="submit") Отправить
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      text: null,
      textRules: [v => !!v || "Поле не должно оставаться пустым"],
      data: null
    };
  },

  methods: {
    submit() {

    }
  }
};
</script>
