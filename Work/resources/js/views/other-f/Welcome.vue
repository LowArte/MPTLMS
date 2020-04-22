<template lang="pug">
  v-layout(row wrap)
    v-flex(xs12)
      v-card.mx-auto.mt-4(:elevation='0' max-width='620px')
        v-img.mx-auto(:src="loadImg('main-logo.png')" max-width='192px' height='auto')
        v-card-text.pt-3.subtitle-1
          center Московский приборостроительный техникум
          center РЭУ имени Г.В. Плеханова
    v-flex(xs12)
      c-specialties-list
    v-flex(xs12)
      v-card(:elevation='0', color='secondary')
        v-card.mx-auto(max-width='620px' :elevation='0' color='secondary')
          v-card-title.white--text.subtitle-1.black--text.text-truncate Центр дополнительного образования
          v-card-text.white--text Московский приборостроительный техникум предоставляет услуги дополнительного образования, с которыми можно ознакомиться на сайте.
          v-card-actions
            v-btn(text block color='white' dark href='https://ucmpt.ru/') Перейти на сайт
</template>

<script>
import SpecialitiesList_C from "@/js/components/information-page-f/SpecialtiesList";

export default {
  components: {
    "c-specialties-list": SpecialitiesList_C
  },
  methods: {
    loadImg: function(path) {
      return require(`@img/${path}`);
    }
  }
};
</script>