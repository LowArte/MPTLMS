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
            v-form.ma3
                v-text-field(label="E-mail" name="email" required)
                v-card-actions.text-right
                    router-link(class='nounderline' to="/login" active-class="") 
                        v-btn(color="accent"  text) Отмена
                    v-spacer
                    v-btn(type="submit" text) Отправить
</template>

<script>
export default {
}
</script>