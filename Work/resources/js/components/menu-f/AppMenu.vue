<template lang='pug'>
    v-treeview(v-if="user" activatable dense :items="three" open-on-click)              
      template(v-slot:prepend="{ item }") 
        v-icon(v-if="item.icon") {{item.icon}}
      template(v-slot:label="{item}" )
        div(v-if="item.component" @click="navigate(user.post.slug+'/'+item.component.info.url)")
          span {{item.text}} 
        span(v-else) {{item.text}}
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["user"])
  },

  data(){
    return{
      three: null
    }
  },

  beforeMount(){
    this.three = this.user.post.privilegies.filter(res => {return res.menu;});
  },

  methods: {
    navigate(path) {
      this.$router.push("/" + path, null, () => {});
    }
  }
};
</script>