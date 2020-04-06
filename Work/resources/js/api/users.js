//? Документация к api ------------------------

//! Описание
// Api для работы с пользователями системы

//! Таблицы базы данных
//

//! Метод 
/**
 * 
 */

//! Метод 
/**
 * 
 */

import axios from 'axios'
import withSnackbar from "@/js/components/mixins/withSnackbar";
import {
    resetRouter
} from "@/js/router/router";
import * as mutations from "@/js/store/mutation-types";

export default {
    mixins: [withSnackbar],
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
    getUsers() {
        return axios.get('/api/getters/users').then(result => {
                return result.data.users;
            })
            .catch(exception => {
                this.showError("Произошёл сбой:  " + exception);
                return undefined
            });
    },

    //*Получение пользователей
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERS* (Пользователи)
    //? Возвращается экзмемпляр данных по id
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getUser(user_id) {
        return axios.get('/api/admin/getters/users/' + user_id);
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
    saveUser(user) {
        axios.post('/api/admin/user_management/save', {
                "user": user
            }).then(result => {
                this.showMessage("Действие выполнено успешно");
            })
            .catch(exception => {
                this.showError("Произошёл сбой: " + exception);
            });
    },

    //*Удаление пользователя
    //! Комментарий ---------------------------
    //? Реализуется удаление данных из таблицы *USERS* (Пользователи)
    //? Передаётся id в функцию
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    deleteUser(user_id) {
        axios.post('/api/admin/user_management/delete/' + user_id)
            .then(result => {
                this.showMessage("Действие выполнено успешно");
            })
            .catch(exception => {
                this.showError("Произошёл сбой: " + exception);
            });
    },

    //*Редактирование пользователя
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *USERS* (Пользователи)
    //? Передаётся ОДИН экземпляр записи 
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    editUser(user) {
        axios.post('/api/admin/user_management/edit/', {
                "user": user
            }).then(result => {
                this.showMessage("Действие выполнено успешно");
            })
            .catch(exception => {
                this.showError("Произошёл сбой: " + exception);
            });
    },

    //*Логическое удаление пользователей
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *USERS* (Пользователи) С ВОЗМОЖНОСТЬЮ ВОССТАНОВЛЕНИЯ
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    dropUsers() {
        axios.post('/api/admin/user_management/deleteAll')
            .then(result => {
                this.showMessage("Действие выполнено успешно");
            })
            .catch(exception => {
                this.showError("Произошёл сбой: " + exception);
            });
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
        axios.post('/logout').then(res => {
            resetRouter()
            this.$store.commit(mutations.SET_NOTAUTH)
            this.$router.push("/")
        }).catch(ex => {});
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
