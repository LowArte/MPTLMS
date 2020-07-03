<template lang="pug">
v-card.mx-auto.mb-3(max-width="600px")
    v-system-bar(color="primary" lights-out dark)
        router-link(class='nounderline' :to="'/' + user.post.slug + '/news'")
            v-btn(block x-small) Ко всем новостям
    v-carousel(height="300" min-height="250px" :continuous="false" :cycle="false" :show-arrows="false" delimiter-icon="mdi-minus" v-if="post.images.length > 0")
        v-carousel-item(v-for="(image, i) in post.images" :key="i" :src="image")
    v-system-bar(color="#F5F5F5")
        span Опубликовано: {{post.time}}
    v-content.pt-0.pa-2
        v-card-title {{post.title}}
        v-card-text {{post.text}}
    v-content.pt-0.pa-2(v-if="post.links.length > 0")
        v-system-bar(color="white")
            span Дополнительные материалы
        v-card-text.py-1(v-for="(link, i) in post.links" :key="i")
            a(:href="link") {{link}}
    v-divider
    v-card-actions
        v-btn(text @click="clickLike(post.id)")
            v-icon mdi-heart
            span.mx-2 {{post.likes.length}}
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_new from "@/js/api/new";

//?----------------------------------------------
//!           Подключение vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["user"])
  },
  data: () => {
    return {
      mixins: [withSnackbar],
      clicklike: false,
      post: {
        id: 0,
        time: null,
        images: [],
        title: "",
        text: "",
        links: [],
        likes: []
      }
    };
  },

  methods: {
    clickLike(id) 
    {
      if (this.clicklike) 
      {
        this.post.likes--;
        api_new.likeNews(id);
        this.clicklike = false;
      } 
      else 
      {
        this.post.likes++;
        api_new.likeNews(this.post.id);
        this.clicklike = true;
      }
    }
  }
};
</script>