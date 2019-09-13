<template>
  <div class="home">
    <header>
      <div class="title-menu">
        <h1 class="title">Личный кабинет</h1>
        <div class="container-login100-form-btn">
          <button class="login100-form-btn">ВЫЙТИ</button>
        </div>
      </div>
    </header>
    <aside class="main-menu"></aside>
    <section class="page">
      <!-- <div class="main-menu"></div> -->
      <div class="contents">wsedfghjk</div>
    </section>
    <footer style="height: 1920px;">dklsjf</footer>
  </div>
</template>

<style>
* {
  margin: 0px;
  padding: 0px;
}
*:before,
*:after {
  box-sizing: border-box;
}
body,
html {
  background: #fafafa;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
header {
  position: fixed;
  z-index: 100;
  width: 100%;
  height: 45px;
  background: #303030;
  color: #fafafa;
}
a {
  text-decoration: none;
}
.home {
  position: flex;
}
.page {
  position: flex;
}
.title-menu {
  display: flex;
}
.title {
  font-size: 16pt;
  width: 100%;
  height: 45px;
  padding: 5px;
  margin: 0 15px;
}
.container-login100-form-btn {
  width: auto;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: nowrap;
}
.login100-form-btn {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  margin: 10px;
  justify-content: center;
  align-items: center;
  padding: 0px;
  min-width: 90px;
  height: 25px;
  background-color: #303030;
  border-radius: 10px;
  border-width: 0px;
  border-color: #303030;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-size: 16px;
  color: #fff;
  line-height: 1.2;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.main-menu {
  float: left;
  z-index: 99;
  width: 50px;
  height: 100%;
  margin: 45px 0;
  position: fixed;
  background: #eff1f2;
}

.contents {
  padding: 45px 0 0 55px;
  position: relative;
}

/* Triggers */

.login100-form-btn:hover {
  background-color: #db5656;
  border-color: #db5656;
}

/* Madia qwery */

@media (max-width: 320px) {
  .title {
    font-size: 20px;
  }
}
</style>
