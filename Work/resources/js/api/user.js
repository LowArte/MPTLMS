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
    getUsers(_this) {
        return axios.get('/api/getters/users')
            .then(result => {
                return result.data.users;
            })
            .catch(ex => {
                _this.showError("Ошибка получения данных!");
                return undefined;
            });
    },

    //*Получение пользователя
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERS* (Пользователи)
    //? Возвращается экзмемпляр данных по id
    //! Требование ----------------------------
    //! Пересмотреть (укажи меня)
    //!----------------------------------------
    getUser(user_id, _this) {
        return axios.get('/api/getters/users/' + user_id)
            .then(result => {
                return true;
            })
            .catch(ex => {
                _this.showError("Ошибка получения данных!");
                return undefined;
            });
    },

    //*Установка нового пароля
    //! Комментарий ---------------------------
    //? Реализуется создание нового пароля для пользователя *USERS* (Пользователи)
    //! Требование ----------------------------
    //!----------------------------------------
    ResetPassword(data, _this) {
        return axios.post('/password/reset', data)
            .then(result => {
                _this.showMessage("Выполнено!");
                return true;
            })
            .catch(exception => {
                _this.showError("Ошибка выполнения!");
                return false;
            });
    },

    //*Отправка письма для получения ссылки для указания нового пароля
    //! Комментарий ---------------------------
    //? Реализуется отправка письма для получения ссылки для создание нового пароля для пользователя *USERS* (Пользователи)
    //! Требование ----------------------------
    //!----------------------------------------
    EmailForResetPassword(email, _this) {
        return axios.post('/password/email', {
                "email": email
            })
            .then(result => {
                _this.showMessage("Отправлено!");
                return true;
            })
            .catch(exception => {
                _this.showError("Ошибка выполнения!");
                return false;
            });
    },


    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение пользователя
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблицу *USERS* (Пользователи)
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    saveUser(user, _this) {
        return axios.post('/api/save/user/', user)
        .then(result => { _this.showMessage("Выполнено!"); return res.data.id; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },

    //*Удаление пользователя
    //! Комментарий ---------------------------
    //? Реализуется удаление данных из таблицы *USERS* (Пользователи)
    //? Передаётся id в функцию
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    deleteUser(user_id, _this) {
        return axios.post('/api/delete/user/' + user_id)
            .then(result => {
                _this.showMessage("Выполнено!");
                return true;
            })
            .catch(exception => {
                _this.showError("Ошибка выполнения!");
                return false;
            });
    },

    //*Редактирование пользователя
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *USERS* (Пользователи)
    //? Передаётся ОДИН экземпляр записи 
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    editUser(user, _this) {
        return axios.post('/api/edit/user/', user)
            .then(result => {
                _this.showMessage("Выполнено!");
                return true;
            })
            .catch(exception => {
                _this.showError("Ошибка выполнения!");
                return false;
            });
    },

    //*Вход в систему
    //! Комментарий ---------------------------
    //? Вход в систему *USERS* (Пользователи)
    //! Требование ----------------------------
    //!----------------------------------------
    login(data) {
        return axios.post('/login', data).then(res => {
            console.log(res);
            if(!res.data.profilactic)
            {
                const slug = res.data.user.post.slug;
                const items = this.makeRoutes(res.data.user.post.privilegies, slug);
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
        }).catch(ex => {
            console.log(ex)
            return "Не верные данные!";
        })
    },

    //*Иницилизация пользователя
    //! Комментарий ---------------------------
    //? Получения токена 
    //! Требование ----------------------------
    //!----------------------------------------
    init() {
        return axios.post('/getToken').then(res => {
            if (res.data.success) {
                const slug = res.data.user.post.slug;
                const items = this.makeRoutes(res.data.user.post.privilegies, slug);
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
        }).catch(ex => {
            console.log(ex)
            return undefined;
        })
    },

    logout() {
        return axios.post('/logout')
            .then(res => {
                return true;
            })
            .catch(ex => {
                return false;
            });
    },

    makeRoutes(privilegies, slug) {
        let items = [];
        privilegies.forEach(element => {
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
        });
        
        return items;
    }
}
