<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab>Справки</v-tab>
    <v-tab>Характеристики</v-tab>
    <v-tab-item>
      <OrderCertificate v-bind:info="info"/>
    </v-tab-item>
    <v-tab-item>
      <OrderCharacteristic v-bind:info="info"/>
    </v-tab-item>
  </v-tabs>
</template>

<script>
import OrderCertificate from "./Components/Certificate";
import OrderCharacteristic from "./Components/Characteristic";
export default {
  data: () => ({
    tab: null,
    tabs: 2,
  }),
  props:{
    info:{
      data:String,
      default:null
    }
  },
  components: {
    OrderCharacteristic,
    OrderCertificate
  }
};
</script>

