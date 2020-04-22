<template lang="pug">
v-container(pa-0)
  v-layout.row.wrap
    v-flex(xs12)
      v-card(:elevation='0')
        v-card-title.info--text.font-weight-light
          h2.font-weight-light Специальности
        v-divider.ma-2
        c-specialties-list
    v-flex(xs12)
      v-card(:elevation='0' color='secondary')
        v-card.mx-auto(max-width='620px' :elevation='0' color='secondary')
          v-card-title.white--text.subtitle-1.black--text.text-truncate Центр дополнительного образования
          v-card-text.white--text Московский приборостроительный техникум предоставляет услуги дополнительного образования, с которыми можно ознакомиться на сайте.
          v-card-actions
            v-btn(text block color='white' dark href='https://ucmpt.ru/') Перейти на сайт
</template>

<script>
import SpecialitiesList_C from "@/js/components/information-page-f/AdminSpecialtiesList";
export default {
  components: {
    "c-specialties-list": SpecialitiesList_C
  },
  post_name: {
    name: "Домашняя страница",
    url: ""
  }
};
</script>