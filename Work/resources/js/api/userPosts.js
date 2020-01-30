import axios from 'axios'

export default {
  getPosts() {
    return axios.get('/api/admin/post_management/get_posts');
  },

  savePost(post) {
    return axios.post('/api/admin/post_management/save', {
      "post": post.post
    })
  },

  deletePost(post) {
    return axios.post('/api/admin/post_management/delete/'+post.id)
  },

  editPost(post) {
    return axios.post('/api/admin/post_management/edit/'+post.id, {
      "post": post.post
    })
  },
}