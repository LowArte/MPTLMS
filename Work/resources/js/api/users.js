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
    //! Отсутсвуют
    //!----------------------------------------
    getUsers(_this) {
        return axios.get('/api/getters/users')
        .then(result => { return result.data.users;})
        .catch(ex => { _this.showError("Ошибка получения данных!"); return undefined;});
    },

    //*Получение пользователей
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERS* (Пользователи)
    //? Возвращается экзмемпляр данных по id
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getUser(user_id, _this) {
        return axios.get('/api/getters/users/' + user_id)
        .then(result => {return true;})
        .catch(ex => { _this.showError("Ошибка получения данных!"); return undefined;});
    },


    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение пользователя
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблицу *USERS* (Пользователи)
    //? Передаётся ОДИН экземпляр записи
    //? ВНИМАНИЕ: Имеются пустые поля, которые не заполнеяются в связи с разницей в должностях, т.к. у пользовтелей на разных должностях различаются атрибуты.
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    saveUser(user, _this) {
        return axios.post('/api/save/user/', user)
        .then(result => { _this.showMessage("Выполнено!"); return true; })
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
        .then(result => { _this.showMessage("Выполнено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
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
        .then(result => { _this.showMessage("Выполнено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },

    login(data) {
        return axios.post('/login', data).then(res => {
            const slug = res.data.user.post.slug;
            const items = this.makeRoutes(res.data.user.post.privilegies,slug);
            const user = res.data.user;
            const token = res.data.token;
            return {
                items,
                slug,
                user,
                token
            }
        }).catch(ex => {
            console.log(ex)
            return undefined;
        })
    },

    init() {
        return axios.post('/getToken')
    },

    logout() {
        return axios.post('/logout')
        .then(res => {return true;})
        .catch(ex => {return false;});
    },

    makeRoutes(privilegies,slug) {
        let items = [];
        privilegies.forEach(element => {
            if (element.children) {
                element.children.forEach(child => {
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
            } else {
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
