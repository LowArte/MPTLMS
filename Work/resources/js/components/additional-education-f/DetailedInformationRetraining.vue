<template lang="pug">
  v-card.ma-3
    v-img(max-height="200px" :src="_info.href")
    v-divider
    v-card-title
      h2.info--text.font-weight-light.text-truncate {{ _info.title }}
    v-card-text
      h3.font-weight-light Программа профессиональной переподготовки "{{ _info.title }}"
    v-card-text {{ _info.text }}
    
</template>

<script>
export default {
  props: {
    _info:{
      type:Object,
      default:null
    }
  },
  data: () => {
    return {
      title: "sdfghjkl"
    }
  },
  mounted() {
    console.log(this._info);
  }
}
</script>