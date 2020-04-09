<template lang="pug">
    v-container
        v-card.ma-0.pa-2.mx-auto(style="width: 440px")
            v-card-title
                span.headline Сброс пароля
            //- <!-- @if ($errors->any())
            //- <v-alert class="ma-0 mx-2 pa-3" text dense type="error">
            //-     @foreach ($errors->all() as $error)
            //-     <p class="ma-0 pa-0" class="headline">{{ $error }}</p>  
            //-     @endforeach
            //- </v-alert>
            //- @endif -->
            v-card-text(style="color: #FF3D00;") На вашу почту бедет отправлено письмо с подробной инструкцией. Укажите свою почту в поле ниже
            v-form.ma3(ref="Reset")
                v-text-field(label="E-mail" name="email" :rules="emailRules" required)
                v-card-actions.text-right
                    router-link(class='nounderline' to="/login" active-class="") 
                        v-btn(color="accent"  text) Отмена
                    v-spacer
                    v-btn(text @click="sendQuery()" :loading="loading" :disabled="loading") Отправить
</template>

<script>
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert

export default {
    mixins: [withSnackbar],
    data() {
        return {
            loading: false,
            emailRules: [
                v => !!v || "Поле должно быть заполнено корректно",
                v =>
                /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
                "Не соответствует формату почты"
            ],
        }
    }, 

    methods:{
        sendQuery(){
            this.loading = true;
            if(this.$refs.Reset.validate())
            {
                this.showMessage("Восстановление пароля прошло успешно!");
            }
            else
                this.showError("Укажите корректно почту!");
            this.loading = false;
        }
    }
}
</script>