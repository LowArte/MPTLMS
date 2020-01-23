<template lang="pug">
    v-layout.row.wrap
        v-card(class="mx-auto" max-width="400")
            v-list-item(two-line)
                v-list-item-avatar
                v-list-item-content
                    v-list-item-title.headline {{name}}
                    v-list-item-subtitle Должность: {{}}
            v-divider
</template>

<script>
export default {
  data() {
    return {
        name: "Фамилия Имя Отчество",
        post: "Наименование должности"
    };
  }
};
</script>
