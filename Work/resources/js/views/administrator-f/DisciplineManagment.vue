<template lang="pug">
    v-content.ma-0.pa-2
        div(v-if="showCRUD")
            v-card.mx-auto(height='auto' width='100%')
                v-system-bar(color="info" dark)
                    span CRUD дисциплин
                v-btn.ma-2.ml-1(v-on="on" block @click="NoShow")
                c-crud-discipline(:_db_id = "db_id", :_main="this")
        div(v-else)
            c-upload-file-dialog(ref="upload_dialog")
            v-layout.row.wrap
            v-card.mx-auto(height='auto' width='100%')
                v-system-bar(color="info" dark)
                    span Менеджмент дисциплин
                v-data-table.elevation-0.pa-0.ma-0(:headers="headers" :items="items" item-key="id" no-results-text='Данные отсутствуют' no-data-text='Данные отсутствуют' :page.sync="page" hide-default-footer :items-per-page="itemsPerPage")
                    template(v-slot:top)
                        v-tooltip(bottom)
                            template(v-slot:activator="{ on }")
                                v-btn.ma-2.ml-1(text v-on="on" @click="Update")
                                    v-icon replay
                                    span.ma-2 Обновить
                            span Обновить таблицу
                        v-tooltip(bottom)
                            template(v-slot:activator="{ on }")
                                v-btn.ma-2.ml-1(text color="info" v-on="on" @click="LoadFile")
                                    v-icon mdi-upload
                                    span.ma-2 Загрузить документ
                            span Загрузить файл с данными
                    template(v-slot:item.action="{ item }")
                        v-tooltip(bottom v-if="_func_edit != null")
                            template(v-slot:activator="{ on }")
                                v-icon.small(v-on="on" @click="edit(item)") edit
                            span Просмотреть
                v-layout.row.text-center.pa-2.ma-2
                    v-pagination(v-model="page" :length="pageCount")
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";

//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import CRUD_Discipline from "@/js/views/administrator-f/CRUD/CRUDDiscipline";
import api_discipline from '@/js/api/discipline';

import UploadFileDialog_C from "@/js/components/expention-f/UploadFileDialog";

export default {
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
    //*Подключение дополнительных компонентов
    mixins: [withSnackbar, withOverlayLoading],
    components: {
        "c-upload-file-dialog": UploadFileDialog_C,
        "c-crud-discipline": CRUD_Discipline,
    },
    data(){
        return{
            headers: [
                { text: "Наименование", value: "db_name" },
                { text: "Год", value: "year" },
                { text: "Действия", value: "action", sortable: false }
            ],
            items: [],
            page: 1, //Текущая страница
            itemsPerPage: 30, //Количество отображаемых строк
            pageCount: 0, //Количество страниц
            showCRUD: false,
            db_id: 0,
        }
    }, 
    async beforeMount(){
        await this.Update();
    },

    methods:{
        async Update()
        {
            
        },

        async LoadFile()
        {
            var res = await this.$refs.upload_dialog.pop().then(res => { return res; });
            
            if (res)
            {
                //await api_group.importGroup(res);
                this.Update();
            }
            else
                this.showInfo("Действие отменено пользователем!");
        },
    }
}
</script>