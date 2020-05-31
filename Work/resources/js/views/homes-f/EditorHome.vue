<template lang="pug">
v-content.ma-0.pa-2
    v-layout.row.wrap
        v-flex 
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