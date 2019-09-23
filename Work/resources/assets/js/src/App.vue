<template>
  <div class="maint-div">
    <div id="nav">
      <router-link to="/"></router-link>
    </div>
    <router-view />
  </div>
</template>

<style>
* {
  padding: 0px;
  margin: 0px;
}
body,
html {
  padding: 0px;
  margin: 0px;
  background: #000000;
}
.home {
  height: 100%;
}
.maint-div {
  height: auto;
}
#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
