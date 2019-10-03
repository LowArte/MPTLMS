<template>
    <div class="wrapper">
        <div class="mainbody">
            <div class="lmenu">
                <input class="bmenu" type="button" value="Главная">
                <br>
                <input class="bmenu" type="button" value="Расписание"  @click="openSchedule">
                <br>
                <input class="bmenu" type="button" value="Успеваемость" @click="openConstructorSchedule">
            </div>
            <div class="rframe">
                <right1 v-if="sright1 == true"></right1>
                <right2 v-if="sright2 == true"></right2>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
import right1 from '../views/schedule.vue';
import right2 from '../views/constructor_schedule.vue';
export default {
    data() {
        return {
            sright1: true,
            sright2: false,
            errors: {}
        };
    },
    methods: {
        openSchedule()
        {
            this.sright1 = true;
            this.sright2 = false;
        },
        openConstructorSchedule()
        {
            this.sright1 = false;
            this.sright2 = true;
        }
    },
    components: {
        right1,
        right2
    }
}
</script>

<style>
/***Основное*/
* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
  text-decoration: none;
}
.wrapper{
  display: block;
}

.mainbody{
    margin: 0px;
}
/***Меню*/
.lmenu{
  width: 15%;
  height: 80vh;
  float: left;
  background: #F2F2F2;
  display: block;
  padding-top: 40px;
}

.bmenu{
    font-family: Gilda Display;
    font-style: normal;
    font-weight: normal;
    font-size: 19px;
    line-height: 22px;
    display: flex;
    align-items: center;
    text-align: center;
    border: 0px;
    background: #F2F2F2;
    color: #000000;
    margin-left: 20%;
}
/***Вывод от меню */
.rframe{
  width: 85%;
  float: left;
}
</style>

