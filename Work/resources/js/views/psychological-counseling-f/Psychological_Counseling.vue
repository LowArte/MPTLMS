<template lang="pug">
v-content.ma-0.pa-0
    v-layout.row.wrap
        v-img(max-height="320" src="https://static.tildacdn.com/tild6638-6162-4534-a236-366332316165/558136-PKPAA2-5951.jpg")
        v-card.mx-auto(class="pa-2" flat)
            h1.pa-4.display-1 Психологическое консультирование в МПТ ФГБОУ ВО РЭУ ИМ. Г.В. ПЛЕХАНОВА
            v-card-text Время, когда человек учится — самый активный и яркий период в жизни. Это время поиска собственного пути, становления независимой личности. В связи с этим, во всех сферах жизни происходят значительные изменения: перестраиваются отношения с родителями, формируется новый круг общения, человек пробует себя в новых социальных ролях и ситуациях. Иногда молодой человек перестает справляться с нагрузкой и ищет помощи и поддержки.
            v-card-text Выбор поведения в сложных жизненных ситуациях - самостоятельное решение: кому-то ближе поговорить с родными и близкими, кому-то проще побыть в одиночестве, кто-то пытается уйти от неприятностей, игнорируя происходящее и отвлекаясь от негативных эмоций. И все же наиболее эффективным способом преодоления проблем остается общение с профессиональным психологом - консультантом.
        v-card(width="100%"  class="pa-2" color="grey lighten-3" flat)
            h1.pa-4.display-1 Временный переход на онлайн-консультации
            v-card-text.pb-0 В связи с принятыми в ФГБОУ ВО РЭУ ИМ. Г.В. ПЛЕХАНОВА мерами по профилактике распространения коронавирусной инфекции объявляем о возможности временного переноса очных консультаций в онлайн-формат
            v-card-text.py-0 Если вы были записаны на очную встречу и хотели бы ее перенести в онлайн, вам необходимо позвонить/написать и сообщить об этом психологу
            v-card-text.py-0 Если вы планируете обратиться к психологу онлайн сейчас - Вы можете это сделать:
            v-card-text.py-0 1. По записи и по времени - через кнопку "Запись на прием"
            v-card-text.pt-0 2. Либо по телефону горячей линии 8-903-502-82-50 с 12.00 до 16.00 с понедельника по пятницу
            v-card-actions
                v-btn(outlined color="accent" dark href="https://docs.google.com/forms/d/1urKW1RDSQemzE-6vcDhJdGiWufTtaJ7SAvIoDY-dNJQ/viewform?edit_requested=true" ) Запись на приём
        v-card.mx-auto.pa-4(max-width="320" flat)
            center
                v-flex
                    v-list-item-avatar(size="275")
                        v-img(  src="https://thumb.tildacdn.com/tild6466-6430-4433-b465-623532656230/-/cover/300x300/center/center/-/format/webp/noroot.png")
                v-flex
                    v-list-item-content
                        v-card-text.mb-3(class="headline") Желвицкая Мария Геннадьевна
                        v-list-item-subtitle Педагог-психолог
                        v-list-item-subtitle Телефон: +7 903 502-82-50
                        v-list-item-subtitle E-mail: m.g.jelvitskaya@mpt.ru
                        v-card-text.py-0 Адрес: г. Москва, Нежинская улица, 7, каб. 108
                        v-card-text.py-0 Время консультаций: 10:00-18:00 (понедельник, среда, пятница)
        v-card(width="100%" class="pa-2" color="grey lighten-3" flat)
            center
                v-card-text.mb-3(class="display-2") Запись на консультацию к психологу
                v-card-text(class="headline") Приём доступен для студентов, их родителей, а также сотрудников МПТ РЭУ им. Плеханова
                v-card-actions
                    v-spacer
                    v-btn(outlined color="accent" dark href="https://docs.google.com/forms/d/1urKW1RDSQemzE-6vcDhJdGiWufTtaJ7SAvIoDY-dNJQ/viewform?edit_requested=true" ) Запись на приём
                    v-spacer
</template>