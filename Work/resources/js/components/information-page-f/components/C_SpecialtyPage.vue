
<template lang="pug">
  v-flex.my-2
    v-card.mx-auto(max-width='420px' style='display: flex; flex-direction: column;' height='100%')
      v-img(v-bind:src='item.href' max-height='200px')
      v-card-text.grow 
        v-card-text.my-2.pa-0.subtitle-1.black--text(style='color: #FF3D00' max-height="70") {{item.title}}
        v-card-text.pa-0 {{item.text}}
      v-card-actions.ma-2.mt-0.pa-0.text--center 
        v-dialog( v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
          template(v-slot:activator="{ on }")
            v-btn(block text small color='accent' v-on="on") Подробнее
          v-card
            v-toolbar(dark color="white")
              v-btn(icon dark @click="dialog = false")
                v-icon(color="primary") mdi-close
              v-toolbar-title(primary) Подробная информация
</template>


<script>
export default {
  data() {
    return {
      dialog: false
    };
  },
  props: {
    item: {
      type: Object,
      default: null
    }
  }
};
</script>

<style scoped>
.rounded-card {
  border-radius: 50px;
}
</style>