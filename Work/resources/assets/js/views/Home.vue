<template>
  <div class="home">
    <div class="header">
      <div class="main-title">
        <p>Личный кабинет</p>
      </div>
      <div class="btn">
        <button class="exit">ВЫЙТИ</button>
      </div>
    </div>
    <div class="wrapper">
      <div class="menu">
        <!-- Area for buttons of users -->
      </div>
      <div class="content">
        <!-- Area for contents of users -->
      </div>
    </div>
  </div>
</template>

<style>
* {
  padding: 0px;
  margin: 0px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}

body,
html {
  padding: 0px;
  margin: 0px;
  height: 100%;
  background: #ffffff;
}

div.header {
  position: fixed;
  z-index: 100;
  display: flex;
  width: 100%;
  height: 45px;
  background-color: #303030;
}

div.main-title > p {
  width: 100%;
  font-size: 16pt;
  color: #ffffff;
  align-content: center;
  padding: 5px 5px 5px 10px;
}

/* Wrepper content grid */

.wrapper {
  padding-top: 45px;
  height: 100%;
  display: grid;
  grid-template-columns: 20% 80%;
}

.wrapper > div.menu {
  background-color: #303030;
}

.wrapper > div.content {
  background-color: #ffffff;
}

/* Input styles */

div.main-title {
  width: 100%;
}

input,
button {
  outline: 0 !important;
}

.btn {
  justify-items: stretch;
  align-items: center;
  padding: 8px;
}

.exit {
  width: 100px;
  height: 25px;
  background-color: #dd5858;
  color: #ffffff;
  font-size: 12pt;
  border: none;
  box-shadow: none;
  border-radius: 5px;
  box-sizing: unset;
  -moz-box-sizing: unset;
  -webkit-box-sizing: unset;
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
}

.exit:hover,
.exit:focus,
.exit:active {
  background-color: rgb(248, 58, 58);
  font-size: 12pt;
  -webkit-transform: scale(0.9);
  transform: scale(0.9);
}

/* Media qwery for mobilephons */

/* All for a mobilephons */

@media only screen and (min-width: 320px) and (max-width: 480px) {
  .wrapper {
    padding-top: 55px;
    display: grid;
    grid-template-columns: none;
    grid-template-rows: 15% 85%;
  }
  div.header {
    height: 55px;
  }
  div.main-title > p {
    padding: 10px;
  }
  .btn {
    padding: 14px;
  }
}

@media only screen and (min-width: 480px) and (max-width: 320px) {
  .wrapper {
    padding-top: 55px;
    display: grid;
    grid-template-columns: none;
    grid-template-rows: 15% 85%;
  }
  div.header {
    height: 55px;
  }
  div.main-title > p {
    padding: 10px;
  }
}
</style>
