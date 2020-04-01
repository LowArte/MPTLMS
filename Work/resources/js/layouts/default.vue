<template>
  <v-app>
    <snackbar></snackbar>
    <v-app-bar app>
      <v-toolbar-title class="text-uppercase">
        <span class="font-weight-light" dense>{{ _name }}</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <div v-if="!isAuthenticated">
        <router-link v-if="currentRoute.name !='Login'" class="nounderline" to="/login">
          <v-btn color="accent" text>ВОЙТИ</v-btn>
        </router-link>
        <v-layout vertical v-if="isAuthenticated">
          <v-btn color="primary mr-5" text>в кабинет</v-btn>
          <v-btn text color="accent">ВЫХОД</v-btn>
        </v-layout>
      </div>
      <v-layout vertical v-else>
        <v-btn color="primary mr-5" text>в кабинет</v-btn>
        <v-btn text color="accent">ВЫХОД</v-btn>
      </v-layout>
      <v-btn text href>Обратная связь</v-btn>
    </v-app-bar>
    <v-content style="background: white;">
      <v-container fluid grid-list-md text-xs-center>
        <!-- @if ($profilactic ?? false) -->
        <v-alert class="my-2" text dense type="warning">
          <span class="primary--text subtitle-1" >Ведутся профилактические работы - функциональные возможности системы ограничены. Повторите попытку позднее.</span>
        </v-alert>
        <t1></t1>
        <!-- @endif -->
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
import t1 from "@/js/views/timetable-f/TestNewTimetable";
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["isAuthenticated"]),
    currentRoute: function() {
      return this.$route;
    }
  },

  props: {
    _name: {
      type: String,
      default: "ass"
    }
  },
  components: {
    snackbar,
    t1
  }
};
</script>