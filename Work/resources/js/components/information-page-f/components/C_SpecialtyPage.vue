<template lang="pug">
v-flex.my-2
  v-card.mx-auto(max-width='420px' min-width='310px' style='display: flex; flex-direction: column;' height='100%')
    c-load-image(:_image="item.image")
    v-card-text.grow
      v-card-text.my-2.pa-0.subtitle-1.black--text(style='color: #FF3D00' max-height="70") {{item.dep_name_full}}
      v-card-text.pa-0 {{item.info.text.length > 255 ? (item.info.text.slice(0,255).substr(-1) == '.' ? item.info.text.slice(0,254) + "..." : item.info.text.slice(0,255) + "...") : item.info.text}}
    v-card-actions.ma-2.mt-0.pa-0.text--center
      v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
        template(v-slot:activator="{ on }")
          v-btn(block text small color='accent' v-on="on") Подробнее
        v-card
          v-toolbar(color="white")
            v-btn(icon dark @click="dialog = false")
              v-icon(color="primary") mdi-close
            v-toolbar-title(text--primary) Подробная информация
          v-content.pa-0
            c-load-image(:_image="item.image")
            v-card.ma-2
              v-card-text.title {{item.dep_name_full}}
              v-card-text {{item.info.text}}
              v-card-text Квалификация: {{item.qualification}}
              v-list(v-for="(info,i) in Object.keys(item.info)" :key="i" v-if="info != 'text'" disabled)
                v-card-text.title {{info}}
                v-list-item-group(v-if="typeof(item.info[info]) == 'object'" color="primary")
                  v-list-item(v-for="(item, j) in item.info[info]" :key="j" dense)
                    v-card-text.py-1(v-text="item")
</template>


<script>
import ImageLoad_C from "@/js/components/information-page-f/components/C_ImageLoad";

export default {
  data() {
    return {
      dialog: false,
      error: false
    };
  },
  props: {
    item: {
      type: Object,
      default: null
    }
  },
  computed: {
    image: function() {
      var vm = this;
      return function(value) {
        return this.error ? value : this.loadImg("reu.png");
      };
    }
  },
  components: {
    "c-load-image": ImageLoad_C
  }
};
</script>

<style  lang="scss">
.rounded-card{
  border-radius: 50px;
}
</style>>
