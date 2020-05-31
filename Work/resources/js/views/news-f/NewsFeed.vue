<template lang="pug">
v-content.ma-0.pa-2
  div(name="top" v-if="news.length > 0" )
    c-comfirm-dialog(ref='qwestion')
    v-card.mx-auto.mb-3(max-width="600px" v-for="(post, i) in news" :key="i")
      v-system-bar(color="primary" lights-out dark v-if="user != null && user.post_id != null")
        span {{post.time}}
          v-btn.mx-auto(x-small text @click="openPost(post.id)") Подробнее
        v-spacer
        v-tooltip(v-if="user.post_id == 7 || user.post_id == 1" bottom)
            template(v-slot:activator="{ on }")
                v-btn(icon x-small @click="deletePost(post.id)")
                    v-icon.pa-0.ma-0 close
            span Удалить запись
      c-card-new(:_post = "post")
    v-speed-dial(v-if="news.length > 2" absolute fixed v-model="fab" :bottom="true" :right="true")
      template(v-slot:activator)
        v-btn(v-model="fab" color="primary" dark fab href="#top")
          v-icon keyboard_arrow_up
    v-btn.mx-auto(v-if="news.length > 10" color="primary" block text :loading="loading" :disabled="loading") загрузить ещё
  div(v-else)
    v-alert.mx-auto(border="left" elevation="3" type="warning"  max-width="920px" min-width="300px")
      span Новостей нет

</template>

<script>
import { mapGetters } from "vuex";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение диалога
//?----------------------------------------------
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";
import cardNew_C from "@/js/components/news-f/CardNew";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import loadImage from "@/js/plugins/loadImage";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_new from "@/js/api/new";


export default {
    post_name: {
        name: "Лента новостей",
        url: "news",
        dop_com: [{
            url: "news/:news_id",
            path: "js/components/news-f/NewsOnePage"
        }, ]
    },
    mixins: [withSnackbar],
    computed: {
        ...mapGetters(["user", "news"])
    },
    components: {
        "c-comfirm-dialog": confirmDialog_C,
        "c-card-new": cardNew_C
    },
    data: () => {
        return {
            loading: false,
            fab: false,
        };
    },
    async beforeMount() {
        this.loading = true;
        if (this.news.length == 0) {
          await this.$store.dispatch(actions.SET_NEWS,this.user.id)
        }
        this.loading = false;
    },
    methods: {
        async deletePost(id) {
            if (await this.$refs.qwestion.pop().then(res => { return res; })) {
                if (await api_new.deleteNews(id)) {
                    this.showMessage("Пост удалён!");
                    await this.$store.dispatch(actions.SET_NEWS,this.user.id)
                }
            }
        },
        loadPost() {
            this.loading = true;
            this.loading = false;
        },
        openPost(id) {
            this.loading = true;
            this.$router.push("news/" + id);
            this.loading = false;
        }
    }
};
</script>