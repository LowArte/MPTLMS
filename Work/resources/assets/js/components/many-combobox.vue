
<template>
    <div class="ui-combobox">
        <div class="ui-value" placeholder="Отделение" multiple></div>
        <div class="ui-options">
            <label><input type="radio" toggle /> Выбрать все</label>
            <label><input type="radio" value="1" /> Option 1</label>
            <label><input type="radio" value="2" /> Option 2</label>
            <label><input type="radio" value="3" /> Option 3</label>
            <label><input type="radio" value="1" /> Option 1</label>
            <label><input type="radio" value="2" /> Option 2</label>
            <label><input type="radio" value="3" /> Option 3</label>
            <label><input type="radio" value="1" /> Option 1</label>
        </div>
    </div>
</template>

<script>
export default {
   data: {
    value: 100
  }
}
</script>

<style>

/***Размер поля */
.ui-combobox {
  display: inline-block;
  position: relative;
  line-height: normal;
  user-select: none;
  text-align: left;
  color: #88a6b6;
  margin-top: 2%;
  margin-left: 2%;
}
/***Настройка картинки */
.ui-combobox:after,
.ui-combobox.ui-combobox-filter:before {
  font-family: "ico";
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  cursor: pointer;
  position: absolute;
  line-height: 0;
  z-index: 10;
  top: 50%;
}
/***Картинка */
.ui-combobox:after {
  content: "\e60a";
  font-size: 2.2em;
  right: 0.3em;
  /*falback*/
  content: "�";
  font-size: 1em;
  right: 0.6em;
}
/***Цвет выделения основного поля*/
.ui-combobox:hover > .ui-value,
.ui-combobox:hover:before,
.ui-combobox:hover:after,
.ui-combobox > .ui-value[count]:not([multiple]):not([count=""]):not([count="0"]):not([count="1"]):before,
.ui-combobox > .ui-value:not(:empty) {
  color: #4fe731;
}
/***Настройки поля */
.ui-combobox > .ui-value[placeholder]:not([placeholder=""]):empty:before {
  content: attr(placeholder);
  font-size: inherit;
  color: inherit;
  position: static;
  line-height: inherit;
}
/***Настройка поля */
.ui-combobox > .ui-value {
  display: block;
  position: relative;
  cursor: pointer;
  padding: 0.93em 3.3em 0.93em 1.2em;
  border: 1px solid #e4ebec;
  border-radius: 0.214em;
  color: #88a6b6;
  background: #fff;
  z-index: 5;
}
/***Настройка выпадающего списка */
.ui-combobox > .ui-options {
  display: block;
  position: absolute;
  border: 1px solid #e3e3e3;
  border-radius: 0.2857em;
  min-width: 110%;
  background: #fff;
  padding: 0.4em 0;
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
  margin-top: -0.357em;
  left: 50%;
  transform-origin: center bottom;
  perspective-origin: center bottom;
  transform: perspective(500px) translateX(-50%) translateY(-100%) rotateX(70deg);
  opacity: 0;
  transition: all 0.3s, opacity 0.15s;
  pointer-events: none;
  white-space: nowrap;
}
/***Анимация выпадения*/
.ui-combobox:hover > .ui-options {
  pointer-events: auto;
  transition: all 0.3s, opacity 0.4s;
  transform: translateX(-50%) translateY(0%);
  opacity: 1;
  animation: ui-combobox-options 0.4s 0.2s linear both;
}
/***Не понятная хрень */
@keyframes ui-combobox-options {
  0% {
    margin-top: 1em;
    z-index: 1;
  }
  50% {
    margin-top: -0.357em;
  }
  100% {
    margin-top: -0.357em;
    z-index: 10;
  }
}
/***Выпадение вертикально */
.ui-combobox > .ui-options > * {
  display: block;
  cursor: pointer;
  position: relative;
  padding: 0.6em 3em 0.6em 1.0714em;
}
/***Цвет выбора элементов */
.ui-combobox > .ui-options > *:hover {
  background: #1d09d4;
}
/***Не понятная хрень */
.ui-combobox > .ui-options > * > * {
  font-weight: normal;
  color: #737d85;
  font-size: 0.875em;
}
/***Отвечает за появление скролла */
.ui-combobox > .ui-options {
  max-height: 15.625em;
  overflow: hidden;
}
.ui-combobox > .ui-options:hover {
  overflow: auto;
}
/***Не понятно зачем */
.-webkit- .ui-combobox > .ui-options::-webkit-scrollbar {
  width: 0.625em;
  height: 0.625em;
}
.-webkit- .ui-combobox > .ui-options::-webkit-scrollbar-thumb {
  border: 0.1875em solid transparent;
  border-radius: 0.3125em;
  background: rgba(0, 0, 0, 0);
  background-clip: padding-box;
}
.-webkit- .ui-combobox > .ui-options:hover::-webkit-scrollbar-thumb {
  border: 0.1875em solid transparent;
  background: rgba(0, 0, 0, 0.1);
  background-clip: padding-box;
}
.-webkit- .ui-combobox > .ui-options::-webkit-scrollbar-thumb:horizontal:hover,
.-webkit- .ui-combobox > .ui-options::-webkit-scrollbar-thumb:vertical:hover {
  background-color: rgba(0, 0, 0, 0.2);
}
.-webkit- .ui-combobox > .ui-options::-webkit-scrollbar-thumb:horizontal:active,
.-webkit- .ui-combobox > .ui-options::-webkit-scrollbar-thumb:vertical:active {
  background-color: #31a0e7;
}
.-webkit- .ui-combobox > .ui-options::-webkit-scrollbar-corner {
  background: transparent;
}
</style>