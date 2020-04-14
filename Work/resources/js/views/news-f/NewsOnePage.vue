<template lang="pug">
v-card.mx-auto.mb-3(max-width="600px")
    v-system-bar(color="primary" lights-out dark)
        router-link(class='nounderline' :to="'/' + user.post.slug + '/news'")
            v-btn(block x-small) Ко всем новостям
    v-carousel(height="300" min-height="250px" :continuous="false" :cycle="false" :show-arrows="false" delimiter-icon="mdi-minus" v-if="post.media.length > 0")
        v-carousel-item(v-for="(mediain, i) in post.media" :key="i" :src="mediain")
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
        v-btn(text @click="clickLike()")
            v-icon mdi-heart
            span.mx-2 {{post.likes}}
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["user"])
  },
  data: () => {
    return {
      clicklike: false,
      post: {
        id: 0,
        time: new Date().toISOString().substr(0, 10),
        media: [],
        title: "Студент МПТ выиграл WSR",
        text:
          "Победителем WSR стал студент московского приборостроительного техникума",
        links: [],
        likes: 20
      }
    };
  },

  methods: {
    clickLike() {
      if (this.clicklike) {
        this.post.likes--;
        this.clicklike = false;
      } else {
        this.post.likes++;
        this.clicklike = true;
      }
    }
  }
};
</script>