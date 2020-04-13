<template lang="pug">
    v-container.pa-4
        v-layout.row.wrap
            v-flex 
                v-card.mx-auto(outline)
                    v-system-bar
                        span Упарвление новостной лентоый
                    v-card-text В данном разделе представлены быстрые дествия для работа с новостной лентой сайта
                    v-switch.shrink.ma-4(color="primary" value="primary" label="Закрыть ленту для посещения")
                v-card.mx-auto(outline)
                    v-system-bar
                        span Карта пользователя
                    v-card-text В данном разделе представлены быстрые переходы к разделам сайта
                    v-card-actions
                        v-layout.row
                            v-flex
                                router-link(class='nounderline' :to="'/' + user.post.slug + '/news'")
                                    v-btn(color="primary" block dark) Новостная лента
                            v-flex
                                router-link(class='nounderline' :to="'/' + user.post.slug + '/news-constructor'")
                                    v-btn(color="primary" block dark) Создать новую запись
                            v-flex
                                router-link(class='nounderline' :to="'/' + user.post.slug + '/news-statistics'")
                                    v-btn(color="primary" block dark) Статистика
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["user"])
  },
  data() {
    return {};
  }
};
</script>