//Api для работы с ролями системы

import axios from 'axios'

export default {
    //*----------------------------------------
    //!         Модель данных
    //*----------------------------------------
    /**
     * id - BIGINT
     * name - string - not null
     * slud - string - not null
     * privilegie - json not null
     */
    //*----------------------------------------
    

    //*----------------------------------------
    //!         Установка данных
    //*----------------------------------------
    //*Устанавливаеь привилегия на роль
    //! Комментарий ---------------------------
    //? Реализуется запись данных в таблицу *USERSPOST* (Роли)
    //? Возвращается овет от сервера с полем {success}
    //! Входные параметры
    /** data :
     *      id : id роли которую необходимо изменить
     *      privilegies : объект формата JSON в котором описаны доступные пользователю привелегии
    */
    //! Требование ----------------------------
    //! Отсутсвуют
    //!---------------------------------------
    setPostPrivilegies(data) {
        return axios.post('/api/edit/post', data);
    },


    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение полной информации для всех ролей 
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERSPOST* (Роли)
    //? Возвращается {} таблица данных JSON формата
    //! Требование ----------------------------
    //! Отсутсвуют
    //!---------------------------------------
    getPostsFull() {
        return axios.get('/api/getters/posts_full');
    },
    
    //*Получение роли
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERSPOST* (Роли)
    //? Возвращается экзмемпляр данных по id
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getPost(id) {
        return axios.get('/api/admin/getters/posts' + id);
    },
}

    //?----------------------------------------
    //?         Документация
    //?----------------------------------------
    //*
