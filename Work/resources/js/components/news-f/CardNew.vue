<template lang="pug">
div
    v-carousel(height="300" min-height="250px" :continuous="false" :cycle="false" :show-arrows="false" delimiter-icon="mdi-minus" v-if="post.images.length > 0")
        v-carousel-item(v-for="(mediain, i) in post.images" :key="i" :src="mediain")
    v-content.pt-0.pa-2
        v-card-title {{post.title}}
        v-card-text {{post.text}}
    v-divider
    v-card-actions
        v-btn(text @click="clickLike(post.id)" :loading="loading" :disabled="loading")
            v-icon {{!post.isLike ? 'favorite_border' : 'mdi-heart'}}
            span.mx-2 {{post.likes}}
</template>

<script>
import api_new from "@/js/api/new";
import { mapGetters } from "vuex";
import withSnackbar from "@/js/components/mixins/withSnackbar";

export default {
    mixins: [withSnackbar],
    computed: {
        ...mapGetters(["user"])
    },
    data: () => {
        return {
            loading: false,
            post: null
        }
    },

    props:{
        _post:{
            type: Object,
            default: null
        }
    },

    beforeMount()
    {
        this.post = this._post;
    },

    methods: {
        async clickLike(id) 
        {
            this.loading = true;
            var result = await api_new.likeNews({new_id: id, user_id: this.user.id});
            if(result != null)
            {
                this.post.likes = result;
                this.post.isLike = !this.post.isLike;
            }
            else
                this.showError("Произошла ошибка!");
            this.loading = false;
        }
    }
}
</script>