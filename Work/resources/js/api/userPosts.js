//Api для работы с ролями системы

import axios from 'axios'

export default {
    //Получение ролей
    getPosts() {
        return axios.get('/api/getters/posts');
    },

    //Получение ролей для менеджемента
    getPostsForManagement() {
        return axios.get('/api/getters/posts_for_management');
    },
    
    //*Получение роли
    getPost(id) { //! Получение должности по ID
        return axios.get('/api/admin/getters/posts' + id);
    },

    //*Сохранение роли
    savePost(post) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/post_management/save', {
            "post": post
        });
    },

    //*Удаление роли
    deletePost(post_id) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/post_management/delete/' + post_id);
    },

    //*Редактирование роли
    editPost(post) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/post_management/edit/' + post.id, {
            "post": post
        });
    },

    //Полное удаление должностей
    dropPosts() //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/post_management/deleteAll');
    }
}
