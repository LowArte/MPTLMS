//Api для работы с ролями системы

import axios from 'axios'

export default {
    //Получение ролей
    getPosts() {
        return axios.get('/api/getters/posts');
    },

    //*Получение роли
    getPost(id) { //! Получение должности по ID
        return axios.get('/api/admin/getters/posts' + id);
    },

    //Сохранение роли
    savePost(data) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/post_management/save', {
            "post": data.post
        });
    },

    //Удаление роли
    deletePost(post_id) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/post_management/delete/' + post_id);
    },

    //Редактирование роли
    editPost(data) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/post_management/edit/' + data.post_id, {
            "post": data.post
        });
    }
}
