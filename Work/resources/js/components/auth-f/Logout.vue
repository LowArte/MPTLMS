<template>
  <div>
    <v-btn block text color="accent" type="submit">Выход</v-btn>
    <v-btn block text color="info" type="submit" :href="_link" @click="logout">Сменить пароль</v-btn>
  </div>
</template>

<script>
import * as mutations from "../../store/mutation-types";
import { mapGetters } from "vuex";

export default {
  props: {
    _link: {
      type: String,
      default: null
    }
  },
  computed: {
    ...mapGetters(["slugXUY5"])
  },
  methods: {
    logout() {
      console.log(this.slugXUY5);
      this.$store.commit(mutations.SET_SLUG, null);
    }
  }
};
</script>