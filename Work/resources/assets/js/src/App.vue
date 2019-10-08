<template>
  <div id="app">
    <v-app>
      <v-tabs>
        <v-tab>Item One</v-tab>
        <v-tab>Item Two</v-tab>
        <v-tab>Item Three</v-tab>
      </v-tabs>
    </v-app>
    <router-view></router-view>
  </div>
</template>

<script>
import bar from "../components/bar";

export default {
  name: "app",
  data() {
    return {};
  },
  mounted() {
    this.init();
  },
  methods: {
    init() {
      Vue.axios.get("auth/init").then(response => {
        this.$store.dispatch("login", { user: response.data.user });
        console.log(CSRF_TOKKEN);
      });
    }
  },
  components: {
    bar
  }
};
</script>

<style>
* {
  padding: 0px;
  margin: 0px;
  margin-bottom: 0px;
}

html,
body {
  background-color: #434343;
  height: 100%;
  margin: 0px;
}

#app {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}

.non-selected {
  -ms-user-select: none;
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
}

/* Media qwery for mobilephons */

/* All for a mobilephons */

@media only screen and (min-width: 320px) and (max-width: 480px) {
}

@media only screen and (min-width: 480px) and (max-width: 320px) {
}
</style>
