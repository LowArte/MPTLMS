<template>
  <v-app>
    <snackbar></snackbar>
    <v-app-bar app elevate-on-scroll color="white">
      <v-toolbar-title>{{ name }}</v-toolbar-title>
      <v-spacer></v-spacer>
      <router-link v-if="currentRoute.name !='Login' && !isAuthenticated" class="nounderline" to="/login">
        <v-btn color="accent" text small>ВОЙТИ</v-btn>
      </router-link>
      <router-link v-if="isAuthenticated" class="nounderline" :to="`/${user.post.slug}`">
        <v-btn color="primary mr-5" text small>В КАБИНЕТ</v-btn>
      </router-link>
      <c-logout-default v-if="isAuthenticated"></c-logout-default>
    </v-app-bar>
    <v-content style="background: white;">
      <v-container fluid grid-list-md text-xs-center>
        <v-alert v-if="isProfilactic" class="my-2" text dense type="warning">
          <span
            class="primary--text subtitle-1"
          >Ведутся профилактические работы - функциональные возможности системы ограничены. Повторите попытку позднее.</span>
        </v-alert>
        <transition>
          <keep-alive>
            <router-view></router-view>
          </keep-alive>
        </transition>
      </v-container>
    </v-content>
  </v-app>
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