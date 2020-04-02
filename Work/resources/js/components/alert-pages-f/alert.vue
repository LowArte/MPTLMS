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
    v-row.ma-2(align="center" justify="center")
        v-col.pa-auto(justify="center")
            v-card.mx-auto(dark flat max-width="320" color="red")
                v-card-title.pa-3
                    v-icon(large left) mdi-alert
                    span(title font-weight-light) {{error.code}}
                v-card-text.px-0
                    span {{error.annotation}}
                v-card-actions
                    router-link(class='nounderline' to="/") 
                        v-btn(small block dark color="red lighten-1") ГЛАВНАЯ
                        
</template>

<script>
export default {
  props: ["error"]
};
</script>

