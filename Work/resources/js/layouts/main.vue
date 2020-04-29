<template lang="pug">
div
  snackbar
  overlayloader
  v-navigation-drawer(width='300' v-model='leftdrawer' fixed clipped app='')
    c-app-menu
  v-app-bar(color='primary' dark app clipped-left clipped-right fixed='')
    div.ml-0.pl-3(:style="$vuetify.breakpoint.smAndUp ? 'width: 300px; min-width: 250px' : 'min-width: 72px'")
      v-btn(icon @click='leftdrawer = !leftdrawer')
        v-icon menu
    div.d-flex.align-center(v-if='user' style='margin-left: auto')
      notifications
      v-btn.ml-1(text @click.stop='rightdrawer = !rightdrawer' light='')
        small.white--text {{user.name}}
        small.red--text(v-if='user.disabled == 1')
          kbd Заблокирован
        v-avatar.ml-2(size='32' color='white')
          v-icon account_circle
  v-navigation-drawer(v-model='rightdrawer' temporary right clipped fixed app='')
    template(v-slot:prepend='')
      div.pa-2
        c-reset-password
      div.pa-2
        c-logout
  v-content
    v-container(pa-0 fluid grid-list-md text-xs-center='')
      transition(name='page' mode='out-in')
        keep-alive
          router-view
</template>

<script>
import notifications from "@/js/components/notifications-menu-f/NotificationsBar"
import snackbar from "@/js/components/SnackBarComponent";
import overlayloader from "@/js/components/OverlayLoaderComponent";
import C_AppMenu from "@/js/components/menu-f/AppMenu";
import C_Logout from "@/js/components/buttons-f/logout";
import C_resetPassword from "@/js/components/buttons-f/resetPassword";
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["user"])
  },

  data: () => ({
    leftdrawer: false,
    rightdrawer: false
  }),

  components: {
    snackbar,
    overlayloader,
    notifications,
    "c-app-menu": C_AppMenu,
    "c-logout": C_Logout,
    "c-reset-password" : C_resetPassword
  }
};
</script>
