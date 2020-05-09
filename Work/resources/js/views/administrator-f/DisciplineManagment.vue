<template lang="pug">
    v-content.ma-0.pa-2
        div(v-if="showCRUD")
            v-card.mx-auto(height='auto' width='100%')
                v-system-bar(color="info" dark)
                    span CRUD дисциплин
                div.ma-0.pa-1
                    v-btn(block @click="showCRUD = false;") К списку баз данных
                c-crud-discipline(:_db_name = "db_name")
        div(v-else)
            c-upload-file-dialog(ref="upload_dialog")
            v-layout.row.wrap
            v-card.mx-auto(height='auto' width='100%')
                v-system-bar(color="info" dark)
                    span Менеджмент дисциплин
                v-data-table.elevation-0.pa-0.ma-0(:headers="headers" :items="items" item-key="id" no-results-text='Данные отсутствуют' no-data-text='Данные отсутствуют' :page.sync="page" @page-count="pageCount = $event" hide-default-footer :items-per-page="itemsPerPage")
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
                        v-tooltip(bottom)
                            template(v-slot:activator="{ on }")
                                v-icon.small(v-on="on" @click="show(item)") edit
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
                { text: "Год", value: "created_at" },
                { text: "Действия", value: "action", sortable: false }
            ],
            items: [{id: 1, db_name: 'Название базы', year: '2020'}],
            page: 1, //Текущая страница
            itemsPerPage: 30, //Количество отображаемых строк
            pageCount: 0, //Количество страниц
            showCRUD: false,
            db_name: "",
        }
    }, 
    async beforeMount(){
        await this.Update();
    },

    methods:{
        show(item){
            this.db_name = item.db_name;
            this.showCRUD = true;
        },
        async Update()
        {
            this.showLoading("Обновление данных");
            this.items = await api_discipline.getDisciplinesDB();
            this.closeLoading("Обновление данных");
        },

        async LoadFile()
        {
            var res = await this.$refs.upload_dialog.pop().then(res => { return res; });
            
            if (res)
            {
                if(await api_discipline.importDiscipline(res))
                    this.showMessage("Файл загружен!");
                this.Update();
            }
            else
                this.showInfo("Действие отменено пользователем!");
        },
    }
}
</script>