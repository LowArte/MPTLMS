<template>
  <v-flex class="my-2">
    <v-card max-width="420px" style="display:flex;flex-direction: column;"  height="100%">
      <v-img height="200px" v-bind:src="item.href"></v-img>
      <v-content class="pa-0">
        <p class="title mx-4 my-1 text-center" style="color: #FF3D00">{{item.title}}</p>
        <v-divider></v-divider>
      </v-content>
      <v-card-text class="grow">
        <div class="my-1 subtitle-1 black--text">₽ • {{item.cost}}</div>
        <div class="my-4 subtitle-1 black--text">Продолжительность • {{item.time}}</div>
        <div>{{item.text}}</div>
      </v-card-text>
      <v-card-actions>
        <v-btn text small @click="dialog = true">Подать заявку</v-btn>
        <v-spacer></v-spacer>
        <v-btn text small color="accent">Подробнее</v-btn>
      </v-card-actions>
    </v-card>
     <v-dialog v-model="dialog" width="480">
          <v-card>
            <v-card-title class="headline grey lighten-3" primary-title>Заявка</v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" class="py-0">
                    <v-text-field label="Имя" required></v-text-field>
                  </v-col>
                  <v-col cols="12" class="py-0">
                    <v-text-field label="Фамилия" required></v-text-field>
                  </v-col>
                  <v-col cols="12" class="py-0">
                    <v-text-field label="Отчество (при наличии)"></v-text-field>
                  </v-col>
                  <v-col cols="12" class="py-0">
                    <v-text-field label="Email" required></v-text-field>
                  </v-col>
                  <v-col cols="12" class="py-0">
                    <v-text-field label="Телефонный номер" required></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red" text @click="dialog = false">Отмена</v-btn>
              <v-btn color="primary" text @click="dialog = false">Отправить</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
  </v-flex>
</template>

<script>
export default {
  data: () => {
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

<style>
.flexcard {
  display: flex;
  flex-direction: row;
}
</style>