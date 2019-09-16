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
.home {
  height: 100%;
}
.maint-div {
  height: 100%;
}
#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
