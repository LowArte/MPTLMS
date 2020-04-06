<template>
  <div>
    <snackbar></snackbar>
    <v-navigation-drawer width="300" v-model="leftdrawer" fixed clipped app>
      <c-app-menu></c-app-menu>
    </v-navigation-drawer>
    <v-app-bar color="primary" dark app clipped-left clipped-right fixed>
      <div
        :style="$vuetify.breakpoint.smAndUp ? 'width: 300px; min-width: 250px' : 'min-width: 72px'"
        class="ml-0 pl-3"
      >
        <v-btn icon @click="leftdrawer = !leftdrawer">
          <v-icon>menu</v-icon>
        </v-btn>
      </div>
      <div v-if="user" class="d-flex align-center" style="margin-left: auto">
        <v-btn text @click.stop="rightdrawer = !rightdrawer" class="ml-5" light>
          <small class="white--text">
            {{user.name}}
          </small>
          <small v-if="user.disabled == 1" class="red--text">
            {{Заблокирован}}
          </small>
          <v-avatar class="ml-2" size="32" color="white">
            <v-icon>account_circle</v-icon>
          </v-avatar>
        </v-btn>
      </div>
    </v-app-bar>

    <v-navigation-drawer v-model="rightdrawer" fixed right clipped app>
      <v-card outlined style="border: none;" flat>
        <c-logout></c-logout>
      </v-card>
    </v-navigation-drawer>

    <v-content style="background: white;">
        <transition>
          <keep-alive>
            <router-view></router-view>
          </keep-alive>
        </transition>
    </v-content>
  </div>
</template>

<script>
import snackbar from "@/js/components/SnackBarComponent"
import C_AppMenu from "@/js/components/menu-f/AppMenu"
import C_Logout from "@/js/components/buttons-f/logout"
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["user"]),
  },

  data: () => ({
    leftdrawer:false,
    rightdrawer:false,
  }),

  components:{
    snackbar,
    "c-app-menu":C_AppMenu,
    "c-logout":C_Logout
  }
}
</script>