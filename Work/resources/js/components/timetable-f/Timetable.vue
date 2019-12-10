<template lang="pug">
    v-layout.column.wrap
        v-flex.ma-2.row
            v-combobox.ma-1(label="Специальность")
            v-combobox.ma-1(label="Группа" v-model="name")
        v-layout.row.wrap
            v-flex.ma-2
                v-card.pa-2.mx-auto(max-width="320px" style="display: flex; flex-direction: column;" height="100%")
                    v-card-title.primary-title.pt-0 День недели
                    v-card-subtitle Место проведения: 
                    v-divider
                    v-container.grid-list-xs
                        v-card-title.pa-0.accent--text.font-weight-light.text-truncate 10:00 - 11:30 Числитель
</template>

<script>
export default {
  data: () => {
    return {
        name: user == null ? "" : user.name,
    };
  }
};
</script>