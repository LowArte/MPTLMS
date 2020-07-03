<template lang="pug">
div
    v-carousel(height="300" min-height="250px" :continuous="false" :cycle="false" :show-arrows="false" delimiter-icon="mdi-minus" v-if="post.normal_images.length > 0")
        v-carousel-item(v-for="(mediain, i) in post.normal_images" :key="i" :src="mediain.url")
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
import * as actions from "@/js/store/action-types";
import api_new from "@/js/api/new";
import { mapGetters } from "vuex";
import withSnackbar from "@/js/components/mixins/withSnackbar";
import loadImage from "@/js/plugins/loadImage";

export default {
    mixins: [withSnackbar,loadImage],
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
            await this.$store.dispatch(actions.SET_LIKE,{userId:this.user.id,newsId:id})
            this.loading = false;
        }
    }
}
</script>