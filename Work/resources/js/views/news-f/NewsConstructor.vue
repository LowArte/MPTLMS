<template lang="pug">
v-content.ma-0.pa-2
    v-layout.row.wrap
        v-flex   
          v-card
            v-system-bar(color="info" dark)
              span Новая запись
              v-spacer
              v-tooltip(bottom)
                template(v-slot:activator="{ on }")
                  v-btn(x-small text @click="clear") Очистить
                span Очистить форму
            v-form(ref="form")
              v-card-text.pb-0 Медиа данные (только фотографии)
              v-content.pa-3.pt-1
                v-flex(v-for="(image, id) in post.images" :key="id")
                  v-row.pa-0
                      v-file-input(v-model="image.value" max-width="640" label="Изображение" :rules="imageRules" show-size outlined dense prepend-icon="mdi-camera" accept="image/png, image/jpeg" @change="validateExt(image.value)")
                        template( v-slot:selection="{ text }")
                          v-chip(small label color="primary") {{ text }}
                      v-card-actions
                        v-spacer
                        v-btn(color="primary" dark @click="deleteFile(image.id)" icon x-small)
                          v-icon.pa-0.ma-0 close
                v-flex
                  v-btn(outlined color="primary" block dark @click="addFile")
                      v-icon.pa-0.ma-0 add
                v-text-field.ma-4.py-0(v-model="post.title" :rules="titleRules" label="Заголовок" required)
                v-textarea.ma-4.py-0(v-model="post.text" :rules="textRules" auto-grow outlined filled label="Текст записи" required)
                v-card-text.py-0 Ссылки на сторониие материалы
                v-content.pa-3
                  v-flex(v-for="(link, id) in post.links" :key="id")
                    v-row.py-0
                      v-col.py-0(lg="2")
                        v-text-field(v-model="link.value" max-width="640" label="Ссылка на материал" :rules="linkRules" outlined dense prepend-icon="link")
                      v-col.py-0(sm ="1")
                        v-card-actions
                          v-btn(color="primary" dark @click="deleteLink(link.id)" icon x-small)
                            v-icon.pa-0.ma-0 link_off
                  v-btn(outlined color="primary" block dark @click="addLink")
                    v-icon.pa-0.ma-0 link
                v-card-actions
                  v-btn(color="info" block dark @click="submit") Опубликовать
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_new from "@/js/api/new";

export default {
  data: () => ({
    mixins: [withSnackbar],
    post: {
      title: null,
      text: null,
      images: [
        {
          id:
            Math.random()
              .toString(36)
              .substring(2, 15) +
            Math.random()
              .toString(36)
              .substring(2, 15),
          value: [],
          identity: true
        }
      ],
      links: [
        {
          id:
            Math.random()
              .toString(36)
              .substring(2, 15) +
            Math.random()
              .toString(36)
              .substring(2, 15),
          value: [],
          identity: true
        }
      ]
    },
    formHasErrors: false,
    errorMessages: "",
    titleRules: [value => !!value || "У записи должен быть заголовок"],
    textRules: [value => !!value || "У записи должен быть текст"],
    imageRules: [
      value =>
        !value ||
        value.size < 5000000 ||
        "Размер изображения не должен привышать 5 MB",
      value => !value || value.identity || "Файл не является изображением",
      value =>
        !!value || "Поле не должно быть пустым, либо его необходимо удалить"
    ],
    linkRules: [
      value =>
        !!value || "Поле не должно быть пустым, либо его необходимо удалить"
    ]
  }),

  methods: 
  {
    addFile() 
    {
      this.post.images.push({
        id:
          Math.random()
            .toString(36)
            .substring(2, 15) +
          Math.random()
            .toString(36)
            .substring(2, 15),
        value: [],
        identity: true
      });
    },

    addLink() 
    {
      this.post.links.push({
        id:
          Math.random()
            .toString(36)
            .substring(2, 15) +
          Math.random()
            .toString(36)
            .substring(2, 15),
        value: [],
        identity: true
      });
    },

    deleteFile(id) 
    {
      this.post.images.deleteById(id);
    },

    deleteLink(id) 
    {
      this.post.links.deleteById(id);
    },

    validateExt(item) 
    {
      if (item) 
      {
        if (item.name) 
        {
          var extFile = item.name.substr(item.name.lastIndexOf(".") + 1, item.name.length).toLowerCase();
  
          if (extFile == "jpg" || extFile == "jpeg" || extFile == "png")
            item.identity = true;
          else 
            item.identity = false;
        }
      }
    },

    submit() 
    {
      if (this.$refs.form.validate())
        api_new.insertNews(this.post);
      else
        this.showError("Заполните корректно поля!");
    },

    clear() 
    {
      this.$refs.form.reset();
    }
  }
};
</script>