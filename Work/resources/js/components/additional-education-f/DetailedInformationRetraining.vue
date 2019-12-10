<template lang="pug">
  v-card.mt-5(:elevation="3" )
    v-img(max-height="200px" src="https://avatars.mds.yandex.net/get-zen_doc/1895227/pub_5cdc919cdee36d00b47e3b8b_5cdc91b81d586800b38792f5/scale_1200")
    v-divider
    v-card-title
      h2.info--text.font-weight-light.text-truncate FrontEnd разработка и WEB-дизайн
    v-card-text
      h3.font-weight-light Программа профессиональной переподготовки "FrontEnd разработка и WEB-дизайн"
    v-card-text Программа соответствует профессиональному стандарту 06.035 «Разработчик WEB и мультимедийных приложений». Вид профессиональной деятельности «Проектирование, разработка и интеграция информационных ресурсов в локальной сети и информационно-телекоммуникационной сети «Интернет»
    v-card-title Общие сведения
    v-layout.row.wrap.pa-3
      v-flex.my-2
        v-card.mx-auto(width="250px" style="display: flex; flex-direction: column;" height="100%" )
          v-icon.mt-3(size="96px") event
          v-card-text.grow
                      .my-1.subtitle-1(style="color: #FF3D00") Начало обучения
                      .my-1.black--text Ноябрь 2019 по воскресеньям
      v-flex.my-2
        v-card.mx-auto(width="250px" style="display: flex; flex-direction: column;" height="100%" )
          v-icon.mt-3(size="96px") schedule
          v-card-text.grow
                      .my-1.subtitle-1(style="color: #FF3D00") Время обучения
                      .my-1.black--text с 11:00 – 16:00
      v-flex.my-2
        v-card.mx-auto(width="250px" style="display: flex; flex-direction: column;" height="100%" )
          v-icon.mt-3(size="96px") font_download
          v-card-text.grow
                      .my-1.subtitle-1(style="color: #FF3D00") Объём программы
                      .my-1.black--text 250 ак. часов "из них 108 аудиторных"
      v-flex.my-2
        v-card.mx-auto(width="250px" style="display: flex; flex-direction: column;" height="100%" )
          v-icon.mt-3(size="96px") attach_money
          v-card-text.grow
                      .my-1.subtitle-1(style="color: #FF3D00") Стоимость обучения на программе
                      .my-1.black--text 38 600 рублей оплата возможна в 2 этапа
      v-flex.my-2
        v-card.mx-auto(width="250px" style="display: flex; flex-direction: column;" height="100%" )
          v-icon.mt-3(size="96px") people
          v-card-text.grow
                      .my-1.subtitle-1(style="color: #FF3D00") Категория слушателей
                      .my-1.black--text к освоению программы допускаются лица, имеющие или получающие среднее профессиональное и/или высшее образование.
      v-flex.my-2
        v-card.mx-auto(width="250px" style="display: flex; flex-direction: column;" height="100%" )
          v-icon.mt-3(size="96px") contacts
          v-card-text.grow
                      .my-1.subtitle-1(style="color: #FF3D00") Контакты
                      .my-1.black--text 8(903)105-90-17 uc@mpt.ru
    v-card-title Документ об окончании
    v-layout.row.wrap.mb-3
      v-flex.my-2
        v-card.mx-auto(max-width="420px" :elevation="0")
          v-card-text.grow.my-1.black--text.py-0 При успешном окончании обучения выдаётся диплом о профессиональной переподготовке Российского экономического университета им. Г.В. Плеханова
      v-flex.my-2
        v-card.mx-auto.mb-3(max-width="320px" style="box-shadow: 0px 6px 15px 0px rgba(0,0,0,.5)")
          v-img( src="https://cdn.shortpixel.ai/client/q_lossless,ret_img,w_768/https://ucmpt.ru/wp-content/uploads/2019/02/%D0%94%D0%B8%D0%BF%D0%BB%D0%BE%D0%BC-%D0%A0%D0%AD%D0%A3-%D0%B8%D0%BC-%D0%93.%D0%92-768x543.png" ) 
</template>

<script>
export default {
  props: {},
  data: () => {
    return {
      title: "sdfghjkl"
    };
  },
  mounted() {}
};
</script>