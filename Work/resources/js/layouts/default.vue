<template lang="pug">
  v-app(style='background: white;')
    snackbar
    v-app-bar(app elevate-on-scroll color='white')
      v-toolbar-title {{ name }}
      v-spacer
      router-link.nounderline(v-if="currentRoute.name !='Login' && !isAuthenticated" to='/login')
        v-btn(color='accent' text small) ВОЙТИ
      router-link.nounderline(v-if='isAuthenticated' :to='`/${user.post.slug}`')
        v-btn(color='primary mr-5' text small) В КАБИНЕТ
      c-logout-default(v-if='isAuthenticated')
    v-content(style='background: white;')
      v-container(pa-0 fluid grid-list-md text-xs-center='')
        v-alert.my-2(v-if='isProfilactic' text dense type='warning')
          span.primary--text.subtitle-1 Ведутся профилактические работы - функциональные возможности системы ограничены. Повторите попытку позднее.
        transition
          keep-alive
            router-view
</template>

<script>
import snackbar from "@/js/components/SnackBarComponent";
import C_Logout from "@/js/components/buttons-f/logout-default";
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["isAuthenticated", "user", "isProfilactic", "name"]),
    currentRoute: function() {
      return this.$route;
    }
  },
  components: {
    snackbar,
    "c-logout-default": C_Logout
  }
};
</script>