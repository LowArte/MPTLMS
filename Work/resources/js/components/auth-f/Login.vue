
<template lang="pug">
  v-container(pa-0 text-center)
    v-row
      v-col(cols="12")
        v-text-field(name="email" :rules="emailRules"  label="Email" required)
      v-col(cols="12")
        v-text-field(min="6" label="Пароль" :rules="passwordRules" name="password" type="password" required)
      v-btn(color="accent font-weight-light" text href="/password/reset")
        small Не можете войти?
      div(class="flex-grow-1")
      v-btn(color="accent" href="/" text) Отмена
      v-btn( type="submit" color="blue darken-1" text) ВОЙТИ
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