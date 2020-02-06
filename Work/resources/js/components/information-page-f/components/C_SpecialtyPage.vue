
<template lang="pug">
  v-flex.my-2
    v-card.mx-auto(max-width='420px' style='display: flex; flex-direction: column;' height='100%')
      v-img(v-if='item.href != null' v-bind:src='item.href' max-height='200px')
        template(v-slot:placeholder)
          v-row(class="fill-height ma-0" align="center" justify="center")
            v-progress-circular(indeterminate color="grey lighten-5")
      v-btn(v-if='item.href == null' block) Добавить изображение
      v-card-text.grow 
        v-card-text.my-2.pa-0.subtitle-1.black--text(style='color: #FF3D00' max-height="70") {{item.title}}
        v-card-text.pa-0 {{item.text}}
      v-card-actions.ma-2.mt-0.pa-0.text--center 
        v-dialog( v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
          template(v-slot:activator="{ on }")
            v-btn(block text small color='accent' v-on="on") Подробнее
          v-card
            v-toolbar(color="white")
              v-btn(icon dark @click="dialog = false")
                v-icon(color="primary") mdi-close
              v-toolbar-title(text--primary) Подробная информация
            v-content.pa-0
              v-img(v-bind:src="item.href" max-height='256px')
                template(v-slot:placeholder)
                  v-row(class="fill-height ma-0" align="center" justify="center")
                    v-progress-circular(indeterminate color="grey lighten-5")
              v-card.ma-2
                v-card-text.title {{item.title}}
                v-card-text {{item.text}}
                v-card-text Квалификация: {{item.qualification}}
                v-list(disabled)
                  v-card-text.title Профессиональные сертификации
                  v-list-item-group(color="primary")
                    v-list-item(v-for="(item, i) in item.certifications" :key="i" dense)
                      v-card-text.py-1(v-text="item")
                  v-card-text.title Наши выпускники умеют
                  v-list-item-group(color="primary")
                    v-list-item(v-for="(item, i) in item.skills" :key="i" dense)
                      v-card-text.py-1(v-text="item")
                  v-card-text.title На специальности изучаются
                  v-list-item-group(color="primary")
                    v-list-item(v-for="(item, i) in item.learning" :key="i" dense)
                      v-card-text.py-1(v-text="item")
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