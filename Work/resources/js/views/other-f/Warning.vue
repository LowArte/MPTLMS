<template lang="pug">
  v-layout.row.justify-center
      v-card(:elevation="0" width="320")
        v-img.mx-auto(:src="loadImg('main-logo.png')" max-width="192px" height="auto")
        v-card-title.accent(style="color: white;") Внимание
        v-card-text.pt-3.primary(style="color: white;") Страница находится в разработке и не доступна в данный момент. Как только раздел будет запущен, система уведомит Вас об этом. Спасибо за ожидание.
</template>

<script>

export default {
  post_name: {
    name: "warning",
    url: "warning"
  },

  methods: {
    loadImg: function(path){
      return require(`@img/${path}`);
    }
  }
};
</script>