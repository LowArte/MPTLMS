<template lang="pug">
    v-badge(color="accent" overlap left)
        template(v-slot:badge)
            span(v-if="messages.length != 0")
                label {{messages.length}}
        v-dialog(v-model="sheet" inset scrollable max-width="550px")       
            template(v-slot:activator="{on}" )
                v-btn(v-if="messages.length != 0" icon width="32" height="32" v-on="on")
                     v-icon notifications
                v-icon(v-else) notifications
            v-card 
                v-card-title Оповещение
                v-btn(class="ma-5" center @click="sheet = false" ) Закрыть      
                v-card-text                                      
                    v-list-item(v-for="(message,i) in messages" :key="i")    
                        v-avatar(class="align-self-start" color="indigo"  class="text-center mr-3")
                            div(class="align-self-center display-1") {{message.data.text[0].toUpperCase() }}                  
                        v-list-item-content(style="display:inline-block" class="mb-2") {{message.data.text}} 
                            v-divider               
                        v-btn(class="mr-auto align-self-end" icon @click="deleteNotification(message)")      
                            v-icon delete                                         
</template>

<script>
import notifications from "../../api/users";
export default {
  data: () => {
    return {
      sheet: false,
      messages: ""
    };
  },
  props: {
    _messages: {
      type: String,
      default: null
    }
  },
  mounted() {
    this.messages = JSON.parse(this._messages);
  },
  methods: {
    deleteNotification(obj) {
      notifications
        .notificate(obj.id)
        .then((req, res) => {
          this.messages.splice(this.messages.indexOf(obj), 1);
          console.log(this.messages);
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>