import axios from 'axios'

export default {
  getRetraining() {
    return axios.get('/api/admin/retraining_management/get_retrainings');
  },

  saveRetraining(retraining) {
    return axios.post('/api/admin/retraining_management/save', {
      "retraining": retraining.retraining
    })
  },

  deleteRetraining(retraining) {
    return axios.post('/api/admin/retraining_management/delete/'+retraining.id)
  },

  editRetraining(retraining) {
    return axios.post('/api/admin/retraining_management/edit/'+retraining.id, {
      "retraining": retraining.retraining
    })
  },
}