<template lang="pug">
    v-btn.my-2.white--text(color='warning' @click="download") Загрузить
        v-icon(dark, right) cloud_download
</template>

<script>
import user_api from "./../../api/users";
import FileDownload  from "js-file-download"
export default {
  props: {
    _file_path: {
      type: String,
      default: null
    }
  },
  methods: {
    download() {
      user_api
        .downloadFile(this._file_path)
        .then(res => {
            FileDownload(res.data, this._file_path.split("/").pop())
        })
    }
  }
};
</script>