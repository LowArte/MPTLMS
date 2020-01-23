import axios from 'axios'

export default {
  getPosts() {
    return axios.get('/api/admin/post_managment/get_posts');
  },

  savePost(post) {
    return axios.post('/api/admin/post_managment/save', {
      "post": post.post
    })
  },

  deletePost(post) {
    return axios.post('/api/admin/post_managment/delete/'+post.id)
  },

  editPost(post) {
    return axios.post('/api/admin/post_managment/edit/'+post.id, {
      "post": post.post
    })
  },
}