//? Документация к компоненту ------------------------

//! Описание -----------------------------------------
/** 
 * Компонент для отображения ошибок доступа к страницам.
 * Имеет в своем распоряжение параметр, получаемый из вне.
 * В качестве параметра предаётся объект, описанный ниже.
 */

//! Объекты и параметры
/**
 * error: {
 *    code: string,
 *    annotation: string
 * }
 */

<template lang="pug">
    v-row.ma-0(align="center" justify="center" style="background-color: #1e2124")
        v-col.pa-auto(align="center" justify="center" style="background-color: transparent")
            v-flex
                v-card(:elevation="0" style="background-color: transparent" dark)
                    p.ma-0.display-4.font-weight-bold 404
                    v-card-text Кажется у нас проблемы, Хюстон! 
                    v-card-actions
                        v-spacer
                        v-btn(x-small text) Обрнатно на помойку
                        v-spacer
                                                
</template>

<script>
export default {
  props: ["error"],
  methods: {
    loadImg: function(path) {
      return require(`@img/${path}`);
    }
  }
};
</script>
