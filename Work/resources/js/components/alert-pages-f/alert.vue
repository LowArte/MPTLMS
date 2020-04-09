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
    v-row.ma-0.mx-0.my-0(align="center" justify="center" style="background-color: #1e2124")
        v-col.pa-0(align="center" justify="center" style="background-color: transparent")
            v-flex
                v-card(:elevation="0" style="background-color: transparent" dark)
                    p.ma-0.display-4.font-weight-bold 404
                    v-card-text Кажется у нас проблемы, Хюстон! 
                    v-card-actions(v-if="isAuthenticated")
                        v-spacer
                        router-link(:to="`/${user.post.slug}`") 
                          v-btn(x-small text) Обратно в кабинет
                        v-spacer   
                    v-card-actions(v-else)
                        v-spacer
                        router-link(to="/") 
                          v-btn(x-small text) Обратно в интернет
                        v-spacer                        
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["isAuthenticated", "user"]),
  },
  props: ["error"],
  methods: {
    loadImg: function(path) {
      return require(`@img/${path}`);
    }
  }
};
</script>
