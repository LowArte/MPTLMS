<template lang="pug">
    div(class="text-center")
        v-menu(v-model="menu" :close-on-content-click="false" offset-y)
            template(v-slot:activator="{ on }")
              v-badge(bordered :content="unread_notifications_count" :value="unread_notifications_count" color="accent" overlap)
                v-btn(icon small v-on="on")
                    v-icon notifications
            v-card
                v-system-bar(color="pimary")
                    span Последние уведомления
                v-list.pb-0(items v-if="unread_notifications_count > 0 && items.info")
                  v-list-item(v-if="!item.done && index <= 5" v-for="(item, index) in items.info.slice().reverse()" :key="index" :item="item")
                        v-list-item-avatar
                            v-icon {{item.icon}}
                        v-list-item-content
                            v-list-item-title {{item.title}}
                            v-list-item-subtitle {{item.subtitle}}
                        v-list-item-action
                          v-btn(icon small :color="!item.done ? 'accent' : 'primary'" dark @click="accept(item)")
                            v-icon(:color="item.done ? 'grey' : 'accent'") {{!item.done ? 'done' : 'done_all'}}
                v-list.pb-0(v-else)
                  v-list-item
                      v-list-item-content
                          v-list-item-subtitle
                              div(class="text-center")
                                  span Нет новых уведомлений
                v-divider                    
                v-card-actions.pa-2
                  v-spacer
                  router-link(class='nounderline' :to="'/' + user.post.slug + '/notifications'") 
                    v-btn.mx-auto(text block x-small color="accent" dark) центр уведомлений
                  v-spacer
</template>

<script>
import Notifications from "@/js/plugins/NotificationsHelpers";

import { mapGetters } from "vuex";

export default {
  mixins: [Notifications],
  data: () => ({
    menu: false,
    items: []
  }),

  computed: {
    ...mapGetters(["user", "notifications", "unread_notifications_count"])
  },

  async beforeMount() {
    await this.getNotifications();
    this.items = JSON.parse(JSON.stringify(this.notifications));
  },

  methods: {
    async accept(item) 
    {
      item.done = true;
      await this.editNotifications(this.items);
      this.items = JSON.parse(JSON.stringify(this.notifications));
      if (this.unread_notifications_count == 0) {
        this.menu = false;
      }
    }
  }
};
</script>