<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab :key="item">Справка</v-tab>
    <v-tab :key="item">Характеристика</v-tab>
    <v-tab-item :key="item">
      <OrderCertificate />
    </v-tab-item>
    <v-tab-item :key="item">
      <OrderCharacteristic />
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
    tabitem: [
      {
        name: "Справка",
        com: OrderCertificate
      },
      {
        name: "Характеристика",
        com: OrderCharacteristic
      }
    ]
  }),
  components: {
    OrderCharacteristic,
    OrderCertificate
  }
};
</script>

