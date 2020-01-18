
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
      v-btn(color="primary font-weight-light" block text height="25" href="/password/reset")
        small Не можете войти?
</template>

<script>
export default {
  data() {
    return {
      emailRules: [
        v => !!v || "Почта не соответствует требованиям",
        v =>
          /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "Не соответствует формату почты"
      ],
      passwordRules: [v => !!v || "Пароль не соответствует требования"],
    };
  }
};
</script>