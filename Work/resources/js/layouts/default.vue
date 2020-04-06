<template>
  <v-app>
    <snackbar></snackbar>
    <v-app-bar app>
      <v-toolbar-title class="text-uppercase">
        <span class="font-weight-light" dense>{{ name }}</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <div v-if="!isAuthenticated">
        <router-link v-if="currentRoute.name !='Login'" class="nounderline" to="/login">
          <v-btn color="accent" text>ВОЙТИ</v-btn>
        </router-link>
        <v-layout vertical v-if="isAuthenticated">
          <router-link class="nounderline" :to="`/${user.post.slug}`">
            <v-btn color="primary mr-5" text>в кабинет</v-btn>
          </router-link>
          <c-logout></c-logout>
        </v-layout>
      </div>
      <v-layout vertical v-else>
        <router-link class="nounderline" :to="`/${user.post.slug}`">
          <v-btn color="primary mr-5" text>в кабинет</v-btn>
        </router-link>
        <c-logout></c-logout>
      </v-layout>
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
import C_Logout from "@/js/components/buttons-f/logout"
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["isAuthenticated", "user","isProfilactic","name"]),
    currentRoute: function() {
      return this.$route;
    }
  },
  components: {
    snackbar,
    "c-logout":C_Logout
  }
};
</script>