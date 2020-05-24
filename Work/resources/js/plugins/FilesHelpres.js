export default {
    methods:{
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
              case ".txt": {
                return "mdi-file-document";
                break;
              }
              case ".bat": {
                return "mdi-shield-alert";
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
              case ".bat":
              case ".pdf": {
                return "red";
                break;
              }
              case ".txt": {
                return "blue-grey";
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
    }
}