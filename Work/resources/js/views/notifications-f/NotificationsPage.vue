<template lang="pug">
v-content.ma-0.pa-0
    v-layout.column.wrap(v-if="items.info")
        v-data-iterator(:items="items.info" :items-per-page.sync="items.info.length" hide-default-footer no-data-text="" no-results-text="")
            template(v-slot:header)
                v-toolbar(dense floating :elevation="0" color="boring" )
                    v-btn.ma-0.mx-2(small text color="accent" @click="acceptAll")
                        v-icon() done_all
                        span Отметить все прочитанными
            template(v-slot:default="props" v-if="items.info" )
                v-flex.px-2(v-for="(item, index) in items.info.slice().reverse()" :key="index" :item="item")
                    v-alert.my-1(border="left" colored-border :color="item.icon == 'warning' ? 'error' : 'info'" prominent dense elevation="2" max-width="920px" transition="scale-transition")
                        v-row(align="center")
                            v-col(class="shrink")
                                v-icon {{item.icon}}
                            v-col(class="grow") 
                                p.ma-0 {{item.title}}
                                small {{item.subtitle}}
                            v-col(class="shrink")
                                v-btn(icon small :color="!item.done ? 'accent' : 'primary'" dark @click="accept(item)")
                                    v-icon(:color="item.done ? 'grey' : 'accent'") {{!item.done ? 'done' : 'done_all'}}
</template>

<script>
import Notifications from "@/js/plugins/NotificationsHelpers";

import { mapGetters } from "vuex";

export default {
  mixins: [Notifications],
  data: () => ({
    items: []
  }),

  computed: {
    ...mapGetters(["user", "notifications", "unread_notifications_count"])
  },

  async beforeMount() 
  {
    await this.getNotifications();
    this.items = JSON.parse(JSON.stringify(this.notifications));
  },

  methods: {
    async accept(item) 
    {
      if (!item.done) 
      {
        item.done = true;
        await this.editNotifications(this.items);
        this.items = JSON.parse(JSON.stringify(this.notifications));
      }
    },

    async acceptAll() 
    {
      if (this.unread_notifications_count > 0) {
        await this.editAllNotifications(this.items);
        this.items = JSON.parse(JSON.stringify(this.notifications));
      }
    }
  }
};
</script>