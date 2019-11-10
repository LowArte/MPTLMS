<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab>Справки</v-tab>
    <v-tab>Характеристики</v-tab>
    <v-tab-item>
      <ViewCertificate />
    </v-tab-item>
    <v-tab-item>
      <ViewCharacteristic />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import ViewCertificate from "./Components/ViewCertificate";
import ViewCharacteristic from "./Components/ViewCharacteristic";
export default {
  data: () => ({
    tab: null,
    tabs: 2
  }),
  components: {
    ViewCharacteristic,
    ViewCertificate
  }
};
</script>

