<template lang="pug">
    v-card.ma-2.pa-3
        v-card-title Новая запись
        v-card-text Данная запись будет отображаться в новостной ленте
        v-text-field(label="Заголовок записи")
        v-textarea(label="Техт записи")
        v-divider
        v-card-text Файлы, прикрепляемые к записи (текстовые документа, аудио, видео, фото)
        v-divider
        v-card-actions
            v-btn(color="accent" text) Отложенная запись
            v-spacer
            v-btn(color="accent" text) Опубликовать
            
</template>

<script>
export default {
  data: () => {
    return {};
  }
};
</script>