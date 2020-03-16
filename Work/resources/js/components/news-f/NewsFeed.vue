<template lang="pug">
    div
        v-card.mx-auto.mb-3(max-width="600px" v-for="(index, i) in items" :key="i")
            v-system-bar(color="primary" lights-out dark)
                span Сегодня в 12:00
                v-btn.mx-auto(x-small text) Подробнее
                v-tooltip(bottom)
                    template(v-slot:activator="{ on }")
                        v-btn(icon x-small)
                            v-icon.pa-0.ma-0 close
                    span Удалить запись
            v-carousel(height="300" min-height="250px" :continuous="false" :cycle="false" :show-arrows="false" delimiter-icon="mdi-minus")
                v-carousel-item(v-for="(mediain, i) in index.media" :key="i" :src="mediain")
            v-content.pt-0.pa-2
                v-card-title {{index.title}}
                v-card-text {{index.text}}
            v-divider
            v-card-actions
                v-btn(text)
                    v-icon mdi-heart
                    span.mx-2 {{index.likes}}
                v-btn(text)
                    v-icon comment
                    span.mx-2 {{index.comments}}
                    
            

</template>

<script>
export default {
  data: () => {
    return {
      items: [
        {
          media: [
            "https://picsum.photos/500/250?image",
            "https://picsum.photos/500/480?image",
            "https://picsum.photos/500/480?image",
            "https://picsum.photos/500/480?image"
          ],
          title: "Студент МПТ выиграл WSR",
          text:
            "Победителем WSR стал студент московского приборостроительного техникума",
          likes: "0",
          comments: "0"
        },
        {
          media: [
            "https://picsum.photos/500/250?image",
            "https://picsum.photos/500/480?image",
            "https://picsum.photos/500/480?image",
            "https://picsum.photos/500/480?image"
          ],
          title: "Студент МПТ проиграл WSR",
          text:
            "Проигравшим WSR стал студент московского приборостроительного техникума",
          likes: "0",
          comments: "0"
        }
      ]
    };
  }
};
</script>