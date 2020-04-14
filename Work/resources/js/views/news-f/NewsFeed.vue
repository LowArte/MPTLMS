<template lang="pug">
div(name="top")
  c-comfirm-dialog(ref='qwestion')
  v-card.mx-auto.mb-3(max-width="600px" v-for="(post, i) in posts" :key="i")
      v-system-bar(color="primary" lights-out dark)
          span Сегодня в 12:00
          v-btn.mx-auto(x-small text) Подробнее
          v-tooltip(v-if="user.post_id == 7 || user.post_id == 1" bottom)
              template(v-slot:activator="{ on }")
                  v-btn(icon x-small @click="deletePost(post.id)")
                      v-icon.pa-0.ma-0 close
              span Удалить запись
      v-carousel(height="300" min-height="250px" :continuous="false" :cycle="false" :show-arrows="false" delimiter-icon="mdi-minus")
          v-carousel-post(v-for="(mediain, i) in post.media" :key="i" :src="mediain")
      v-content.pt-0.pa-2
          v-card-title {{post.title}}
          v-card-text {{post.text}}
      v-divider
      v-card-actions
          v-btn(text)
              v-icon mdi-heart
              span.mx-2 {{post.likes}}
          v-btn(text)
              v-icon comment
              span.mx-2 {{post.comments}}
  v-speed-dial(v-if="posts.length > 2" absolute fixed v-model="fab" :bottom="true" :right="true")
    template(v-slot:activator)
      v-btn(v-model="fab" color="primary" dark fab href="#top")
        v-icon keyboard_arrow_up
  v-btn.mx-auto(color="primary" block text :loading="loading" :disabled="loading") загрузить еще
</template>

<script>
import { mapGetters } from "vuex";

//?----------------------------------------------
//!           Подключение диалога
//?----------------------------------------------
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";

export default {
  computed: {
    ...mapGetters(["user"])
  },
  components: {
    "c-comfirm-dialog": confirmDialog_C
  },
  post_name: {
    name: "Лента новостей",
    url: "news"
  },
  data: () => {
    return {
      loading: false,
      fab: false,
      posts: [
        {
          id:
            Math.random()
              .toString(36)
              .substring(2, 15) +
            Math.random()
              .toString(36)
              .substring(2, 15),
          media: [
            "https://picsum.photos/500/250?image",
            "https://picsum.photos/500/480?image",
            "https://picsum.photos/500/480?image",
            "https://picsum.photos/500/480?image"
          ],
          title: "Студент МПТ выиграл WSR",
          text:
            "Победителем WSR стал студент московского приборостроительного техникума",
          likes: "0",
          comments: "0"
        },
        {
          id:
            Math.random()
              .toString(36)
              .substring(2, 15) +
            Math.random()
              .toString(36)
              .substring(2, 15),
          media: [
            "https://picsum.photos/500/250?image",
            "https://picsum.photos/500/480?image",
            "https://picsum.photos/500/480?image",
            "https://picsum.photos/500/480?image"
          ],
          title: "Студент МПТ проиграл WSR",
          text:
            "Проигравшим WSR стал студент московского приборостроительного техникума",
          likes: "0",
          comments: "0"
        }
      ],
      items: []
    };
  },
  methods: {
    deletePost(id) {
      this.$refs.qwestion.pop().then(result => {
        if (result) {
          this.posts.deleteById(id);
        }
      });
    },
    loadPost() {
      this.loading = true;
      /* if(this.items.length >= 10){
        for (let index = this.items.length - this.posts.length; index < index - 10; index--) {
          this.posts.push();
        }
      } else {
        this.posts.push(this.items);
      } */
      console.log(this.items);
      this.loading = false;
    }
  }
};
</script>