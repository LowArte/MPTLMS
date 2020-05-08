//? Документация к api ------------------------

//! Описание
// Api для работы с пользователями системы

//! Таблицы базы данных
//

//! Метод 
/**
 * 
 */

import axios from 'axios'

export default {
    //*----------------------------------------
    //!         Модель данных
    //*----------------------------------------
    /**
     * id - BIGINT
     * 
     */
    //*----------------------------------------
    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение пользователей
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERS* (Пользователи)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getUsers() 
    {
        return axios.get('/api/getters/users')
        .then(res => {return res.data.users;})
        .catch(() => {return undefined;});
    },
    //*Получение пользователя
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERS* (Пользователи)
    //? Возвращается экзмемпляр данных по id
    //! Требование ----------------------------
    //!----------------------------------------
    getUser(user_id) 
    {
        return axios.get('/api/getters/users/' + user_id)
        .then(() => {return true;})
        .catch(() => {return undefined;});
    },
    //*Установка нового пароля
    //! Комментарий ---------------------------
    //? Реализуется создание нового пароля для пользователя *USERS* (Пользователи)
    //! Требование ----------------------------
    //!----------------------------------------
    ResetPassword(data) 
    {
        return axios.post('/password/reset', data)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Отправка письма для получения ссылки для указания нового пароля
    //! Комментарий ---------------------------
    //? Реализуется отправка письма для получения ссылки для создание нового пароля для пользователя *USERS* (Пользователи)
    //! Требование ----------------------------
    //!----------------------------------------
    EmailForResetPassword(email) 
    {
        return axios.post('/password/email', {"email": email})
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение пользователя
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблицу *USERS* (Пользователи)
    //! Требование ----------------------------
    //!----------------------------------------
    saveUser(user) 
    {
        return axios.post('/api/save/user/', user)
        .then(res => {return res.data.id;})
        .catch(() => {return false;});
    },
    //*Удаление пользователя
    //! Комментарий ---------------------------
    //? Реализуется удаление данных из таблицы *USERS* (Пользователи)
    //? Передаётся id в функцию
    //! Требование ----------------------------
    //!----------------------------------------
    deleteUser(user) 
    {
        return axios.post('/api/delete/user/' + user[0] + '/' + user[1])
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Редактирование пользователя
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *USERS* (Пользователи)
    //? Передаётся ОДИН экземпляр записи 
    //! Требование ----------------------------
    //!----------------------------------------
    editUser(user) {
        return axios.post('/api/edit/user/', user)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Вход в систему
    //! Комментарий ---------------------------
    //? Вход в систему *USERS* (Пользователи)
    //! Требование ----------------------------
    //!----------------------------------------
    login(data) 
    {
        return axios.post('/login', data)
        .then(res => {
            if(!res.data.profilactic)
            {
                const slug = res.data.user.post.slug;
                const items = this.makeRoutes(res.data.user.post.privilegies, slug, res.data.user.disabled);
                const user = res.data.user;
                const token = res.data.token;
                return {
                    items,
                    slug,
                    user,
                    token
                }
            }
            return "Система находится в режиме профилактики!";
        })
        .catch(() => {return "Не верные данные!";})
    },

    //*Иницилизация пользователя
    //! Комментарий ---------------------------
    //? Получения токена 
    //! Требование ----------------------------
    //!----------------------------------------
    init() 
    {
        return axios.post('/getToken')
        .then(res => {
            if (res.data.success) 
            {
                const slug = res.data.user.post.slug;
                const items = this.makeRoutes(res.data.user.post.privilegies, slug, res.data.user.disabled);
                const user = res.data.user;
                const token = res.data.token;
                return {
                    items,
                    slug,
                    user,
                    token
                }
            } 
            return undefined;
        }).catch(() => {return undefined;})
    },
    //*Выход из системы
    //! Комментарий ---------------------------
    //? Выход из системы
    //! Требование ----------------------------
    //!----------------------------------------
    logout() {
        return axios.post('/logout')
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Формирование доступных маршрутов
    //! Комментарий ---------------------------
    //? Формирование доступных маршрутов
    //! Требование ----------------------------
    //!----------------------------------------
    makeRoutes(privilegies, slug, disabled) 
    {
        let items = [];
        privilegies.forEach(element => {
            if((disabled == 1 && element.default == true) || disabled == 0)
            {
                if (element.children) 
                {
                    element.children.forEach(child => 
                    {
                        
                        if (child.component != null)
                            items.push({
                                path: "/" + slug + "/" + child.component.info.url,
                                name: child.component.info.name,
                                meta: {
                                    layout: "main"
                                },
                                component: () =>
                                    import(
                                        /* webpackChunkName: "[request]" */
                                        `@/${child.component.path}.vue`
                                    )
                            });
                    });
                } 
                else 
                {
                    items.push({
                        path: "/" + slug + "/" + element.component.info.url,
                        name: element.component.info.name,
                        meta: {
                            layout: "main"
                        },
                        component: () =>
                            import(
                                /* webpackChunkName: "[request]" */
                                `@/${element.component.path}.vue`
                            )
                    });
                }
            }
        });
        return items;
    },
    exportUser() {
        return axios({
                url: '/api/functions/download_user_export',
                method: 'GET',
                responseType: 'blob',
            })
            .then((res) => {
                return res;
            })
            .catch((er) => {
                return er;
            });
    },
    importUser(file) {
        return axios.post('/api/functions/import_user', file, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(() => {
                return true;
            })
            .catch(() => {
                return false;
            });
    }
}