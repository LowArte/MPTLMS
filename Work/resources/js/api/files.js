import axios from 'axios'

export default {
  getFiles() {
    return axios.get('/get_files');
  },

  getFile(name) {
    return axios.get("/get_file", {params: {"name":name}})
  },

  saveFile(file) {
    console.log(file.file);
    return axios.post('/save_file', {
      "file": file.file
    })
  },
  deleteFile(file) {
    return axios.post('/delete_file', {
      "id": file.id
    })
  }
}
