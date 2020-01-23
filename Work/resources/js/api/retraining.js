import axios from 'axios'

export default {
  getRetraining() {
    return axios.get('/api/admin/retraining_managment/get_retrainings');
  },

  saveRetraining(retraining) {
    return axios.post('/api/admin/retraining_managment/save', {
      "retraining": retraining.retraining
    })
  },

  deleteRetraining(retraining) {
    return axios.post('/api/admin/retraining_managment/delete/'+retraining.id)
  },

  editRetraining(retraining) {
    return axios.post('/api/admin/retraining_managment/edit/'+retraining.id, {
      "retraining": retraining.retraining
    })
  },
}