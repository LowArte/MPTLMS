<template lang='pug'>
    v-treeview(v-if="routes" :items="routes" open-on-click)              
      template(v-slot:prepend="{ item }") 
        v-icon(v-if="item.icon") {{item.icon}}
      template(v-slot:label="{item}")
        router-link(class="nounderline" v-if="item.component" to="item.component.info.url")
          span {{item.text}}
        span(v-else) {{item.text}}
</template>

<script>
import {mapGetters} from 'vuex'
export default {
  computed: {
    ...mapGetters(["routes"])
  },
};
</script>