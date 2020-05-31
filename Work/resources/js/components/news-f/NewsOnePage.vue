<template lang="pug">
v-card.mx-auto.mb-3(max-width="600px" v-if="post")
    v-system-bar(color="primary" lights-out dark)
        router-link(class='nounderline' :to="'/' + user.post.slug + '/news'")
            v-btn.mx-auto(text x-small) Ко всем новостям
    v-carousel(height="300" min-height="250px" :continuous="false" :cycle="false" :show-arrows="false" delimiter-icon="mdi-minus" v-if="post.normal_images.length > 0")
        v-carousel-item(v-for="(mediain, i) in post.normal_images" :key="i" :src="mediain.url")
    v-system-bar(color="#F5F5F5")
        span Опубликовано: {{post.created_at}}
    v-content.pt-0.pa-2
        v-card-title {{post.title}}
        v-card-text {{post.text}}
    v-content.pt-0.pa-2(v-if="post.links.length > 0")
        v-system-bar(color="white")
            span Дополнительные материалы
        v-card-text.py-1(v-for="(link, i) in post.links" :key="i")
            a(:href="link.name") {{link.name}}
    v-content.pt-0.pa-2
        v-card-title Комментарии
        v-text-field.ma-2(v-model="text" label="Комментарий")
        v-btn(text @click="sendComment(post.id)") Отправить
        v-row(v-for="(comment,i) in post.comments" :key="i")
            v-col(cols="2")
                v-avatar(color='red' centered size="48")
                    span {{comment.user.name[0]}}
            v-col
                span {{comment.text}}

    v-divider
    v-card-actions
        v-btn(text @click="clickLike(post.id)" :loading="loading" :disabled="loading")
            v-icon {{!post.isLike ? 'favorite_border' : 'mdi-heart'}}
            span.mx-2 {{post.likes}}
</template>

<script>
import * as actions from "@/js/store/action-types";
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import loadImage from "@/js/plugins/loadImage";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_new from "@/js/api/new";

//?----------------------------------------------
//!           Подключение vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

export default {
    mixins: [loadImage, withSnackbar],
    computed: {
        ...mapGetters(["user", "news"])
    },
    data: () => {
        return {
            text:"",
            loading: null,
            post: {
                id: 0,
                time: null,
                title: "",
                text: "",
                normal_images:[],
                links: [],
                likes: 0
            }
        };
    },
    watch: {
        "$route.params.news_id": async function(news_id) {
            if (news_id)
                this.post = this.news.findById(news_id)
        }
    },
    async beforeMount() {
        if (this.news.length == 0) {
            await this.$store.dispatch(actions.SET_NEWS, this.user.id)
        }
        this.post = this.news.findById(this.$route.params.news_id)
        console.log(this.post)
    },
    methods: {
        async clickLike(id) {
            this.loading = true;
            await this.$store.dispatch(actions.SET_LIKE,{userId:this.user.id,newsId:id})
            this.loading = false;
        },
        async sendComment(id) {
            this.$store.dispatch(actions.ADD_COMMENT,{text:this.text,id:id})
        }
    }
};
</script>