<template lang="pug">
    v-layout.column.wrap
        v-card.pa-2( flat min-width="300px")
            v-data-iterator(:items="files" :items-per-page.sync="filesPerPage" hide-default-footer no-data-text="")
                template(v-slot:default="props")
                    v-layout.row.wrap(v-if="files")
                        v-flex(v-for="(file, index) in files" :key="index")
                            v-card.mx-auto.my-2.pa-0(outlined :elevation="0" width="300px")
                                v-list.pa-0(dense flat)
                                    v-list-item-group
                                        v-list-item
                                            v-list-item-avatar
                                                v-icon(:color="getIconColor(file)") {{getIconWithExtention(file)}}
                                            v-list-item-content
                                                v-list-item-title {{getFileName(file)}}
                                            v-list-item-action
                                                v-btn(@click="deleteFileInQwee(file)" icon)
                                                    v-icon close
</template>

<script>
//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      files: [],
      filesPerPage: 0
    };
  },
  computed: {
    ...mapGetters(["user"])
  },
  beforeMount() {
    this.files = this._files;
    this.filesPerPage = this._files.length;
  },
  props: {
    _files: {
      type: Array,
      default: "Файлы отсутсвуют"
    }
  },
  methods: {
    getIconWithExtention(file) {
      switch (this.getExt(file)) {
        case ".xlsx": {
          return "mdi-file-excel";
          break;
        }
        case ".xls": {
          return "mdi-microsoft-excel";
          break;
        }
        case ".docx": {
          return "mdi-file-word";
          break;
        }
        case ".doc": {
          return "mdi-microsoft-word";
          break;
        }
        case ".odt": {
          return "mdi-file-code";
          break;
        }
        case ".ppt":
        case ".pptx": {
          return "mdi-file-powerpoint";
          break;
        }
        case ".pdf": {
          return "mdi-file-pdf";
          break;
        }
        case ".zip":
        case ".7z":
        case ".gz":
        case ".gzip":
        case ".jar":
        case ".rar":
        case ".tar":
        case ".tar-gz":
        case ".tgz":
        case ".zipx": {
          return "mdi-zip-box";
          break;
        }
        default: {
          return "mdi-file-question";
          break;
        }
      }
    },
    getIconColor(file) {
      switch (this.getExt(file)) {
        case ".xlsx":
        case ".xls": {
          return "green";
          break;
        }
        case ".doc":
        case ".docx":
        case ".odt": {
          return "blue accent-4";
          break;
        }
        case ".ppt":
        case ".pptx": {
          return "deep-orange";
          break;
        }
        case ".pdf": {
          return "red";
          break;
        }
        case ".zip":
        case ".7z":
        case ".gz":
        case ".gzip":
        case ".jar":
        case ".rar":
        case ".tar":
        case ".tar-gz":
        case ".tgz":
        case ".zipx": {
          return "indigo";
          break;
        }
        default: {
          return "grey darken-2";
          break;
        }
      }
    },
    getExt(file) {
      let basename = file.split(/[\\/]/).pop();
      let pos = basename.lastIndexOf(".");
      if (basename === "" || pos < 1) return "";
      return basename.slice(pos);
    },
    getFileName(file) {
      return file.split("\\").pop();
    },
    deleteFileInQwee(file) {
      console.log("Файл удалён " + file);
    }
  }
};
</script>