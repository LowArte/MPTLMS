<template lang="pug">
  v-content.pa-3
    v-alert.ma-3(text dense type="warning")
      span(primary--text subtitle-1) Раздел работает в автономном режиме - данные могут не соответсвовать действительности. За подробной информацией обратитесь в центр дополнительного образования.
    v-card.ma-3
      v-img(max-height="300px" :src="_info.href")
      v-divider
      v-card-title
        h2.accent--text.font-weight-light.text-truncate {{ _info.title }}
      v-card-text
        h3.font-weight-light Программа профессиональной переподготовки "{{ _info.title }}"
      v-card-text {{ _info.text }}
    v-layout.pa-4.row.wrap(align-center)
      v-flex.xs12.md4.pa-0
        v-card.ma-3(flat class="transparent" height="360px")
          v-card-text(class="text-center")
            v-icon(x-large class="accent--text text--lighten-2" style="font-size: 128px;") mdi-calendar
          v-card-text.py-0(class="text-center")
            p.headline.accent--text.font-weight-light.text-truncate Начало обучения
          v-card-text.py-0(class="text-center")
            h3.font-weight-light(class="text-center") 25.01.2020
          v-card-text.py-0(class="text-center") по субботам и воскресеньям
      v-flex.xs12.md4.pa-0
        v-card.ma-3(flat class="transparent" height="360px")
          v-card-text(class="text-center")
            v-icon(x-large class="accent--text text--lighten-2" style="font-size: 128px;") mdi-clock
          v-card-text.py-0(class="text-center")
            p.headline.accent--text.font-weight-light.text-truncate Время обучения
          v-card-text.py-0(class="text-center")
            h3.font-weight-light(class="text-center") с 11:00 – 16:00
      v-flex.xs12.md4.pa-0
        v-card.ma-3(flat class="transparent" height="360px")
          v-card-text(class="text-center")
            v-icon(x-large class="accent--text text--lighten-2" style="font-size: 128px;") mdi-message-processing
          v-card-text.py-0(class="text-center")
            p.headline.accent--text.font-weight-light.text-truncate Объём программы
          v-card-text.py-0(class="text-center")
            h3.font-weight-light(class="text-center") 500 ак. часов (из них 216 аудиторных)
      v-flex.xs12.md4.pa-0
        v-card.ma-3(flat class="transparent" height="360px")
          v-card-text(class="text-center")
            v-icon(x-large class="accent--text text--lighten-2" style="font-size: 128px;") mdi-currency-rub
          v-card-text.py-0(class="text-center")
            p.headline.accent--text.font-weight-light.text-truncate Стоимость обучения на программе
          v-card-text.py-0(class="text-center")
            h3.font-weight-light(class="text-center") 73 300 рублей
          v-card-text.py-0(class="text-center")
            h3.font-weight-light(class="text-center") *оплата возможна в 4 этапа
      v-flex.xs12.md4.pa-0
        v-card.ma-3(flat class="transparent" height="360px")
          v-card-text(class="text-center")
            v-icon(x-large class="accent--text text--lighten-2" style="font-size: 128px;") mdi-account
          v-card-text.py-0(class="text-center")
            p.headline.accent--text.font-weight-light.text-truncate Категория слушателей
          v-card-text.py-0(class="text-center")
            h3.font-weight-light(class="text-center") К освоению программы допускаются лица, имеющие или получающие среднее профессиональное и (или) высшее образование.
      v-flex.xs12.md4.pa-0
        v-card.ma-3(flat class="transparent" height="360px")
          v-card-text(class="text-center")
            v-icon(x-large class="accent--text text--lighten-2" style="font-size: 128px;") mdi-telegram
          v-card-text.py-0(class="text-center")
            p.headline.accent--text.font-weight-light.text-truncate Контакты
          v-card-text.py-0(class="text-center")
            h3.font-weight-light(class="text-center") 8-903-105-90-17
          v-card-text.py-0(class="text-center")
            h3.font-weight-light(class="text-center") uc@mpt.ru
</template>

<script>
export default {
  props: {
    _info: {
      type: Object,
      default: null
    }
  }
};
</script>