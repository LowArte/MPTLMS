<template>
  <v-container fluid>
    <v-row v-for="item in items" :key="item" align="center" justify="center">
      <v-col cols="12">
        <v-hover v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto" height="auto" width="auto">
            <v-card-title class="subtitle-1" style="color: #FF3D00;">{{item.group}} - {{item.date}}</v-card-title>
            <v-divider class="my-0"></v-divider>
            <v-simple-table>
              <thead>
                <tr>
                  <th class="text-left">№</th>
                  <th class="text-left">Что заменяют</th>
                  <th class="text-left">На что заменяют</th>
                  <th class="text-left">Дата</th>
                </tr>
              </thead>
              <tbody grow>
                <tr v-for="z1 in z" :key="z1.number">
                  <td>{{ z1.number }}</td>
                  <td>{{ z1.original }} ({{ z1.originalt }})</td>
                  <td>{{ z1.newp }} ({{ z1.newpt }})</td>
                  <td>{{ z1.date }}</td>
                </tr>
              </tbody>
            </v-simple-table>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    items: [
      {
        group: "П-1-16",
        date: "11.10.2019"
      },
      {
        group: "П-2-16",
        date: "12.10.2019"
      },
      {
        group: "П-3-16",
        date: "13.10.2019"
      }
    ],
    z: [
      {
        number: "1",
        original: "Технология разработки и защита баз данных",
        originalt: "Токарчук А.С.",
        newp: "Операционные системы",
        newpt: "Горбунов А.Д.",
        date: "08.10.2019"
      }
    ]
  })
};
</script>