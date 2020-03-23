<template lang="pug">
    div(class="text-center")
        v-menu(v-model="menu" :close-on-content-click="false" offset-y)
            template(v-slot:activator="{ on }")
                v-btn(icon v-on="on")
                    v-icon notifications
            v-card
                v-system-bar(color="pimary")
                    span Уведомления
                v-list.pb-0
                    v-list-item(v-if="items.length > 0" v-for="(item, index) in items" :key="index" :item="item")
                        v-list-item-avatar
                            v-icon {{item.icon}}
                        v-list-item-content
                            v-list-item-title {{item.title}}
                            v-list-item-subtitle {{item.subtitle}}
                        v-list-item-action
                            v-btn(v-if="!item.done" icon small color="accent" dark @click="accept(item)")
                                v-icon done
                            v-btn(v-else icon small disabled)
                                v-icon(color="green") done_all
                    v-list-item(v-else)
                        v-list-item-content
                            v-list-item-subtitle
                                div(class="text-center")
                                    span Нет уведомлений
                    v-divider                    
                v-card-actions.pa-2
                    v-btn(text block x-small color="accent" dark)
                        v-icon expand_more
</template>

<script>
export default {
  data: () => ({
    menu: false,
    items: [
      {
        icon: "warning",
        title: "Система безопасности",
        subtitle: "В ваш аккаунт был осуществёл вход с нового устройства",
        done: false
      },
      {
        icon: "warning",
        title: "Система безопасности",
        subtitle: "В ваш аккаунт был осуществёл вход с нового устройства",
        done: false
      },
      {
        icon: "warning",
        title: "Система безопасности",
        subtitle: "В ваш аккаунт был осуществёл вход с нового устройства",
        done: false
      },
      {
        icon: "warning",
        title: "Система безопасности",
        subtitle: "В ваш аккаунт был осуществёл вход с нового устройства",
        done: false
      },
      {
        icon: "warning",
        title: "Система безопасности",
        subtitle: "В ваш аккаунт был осуществёл вход с нового устройства",
        done: false
      }
    ]
  }),
  methods: {
    accept(item) {
      item.done = true;
    }
  }
};
</script>