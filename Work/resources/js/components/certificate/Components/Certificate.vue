<template>
  <v-row>
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto" height="auto" width="max">
          <v-form v-model="form">
            <v-container>
              <v-row class="pa-2">
                <v-card-text
                  class="my-2 ma-0 pa-0 text-center title"
                >Канцелярия подготавливает только документы, подтверждающие факт обучения в техникуме обучающихся в настоящее время студентов техникума.</v-card-text>
              </v-row>
              <v-row class="pa-2">
                <p>
                  <b>1 заявка = 1 справка в одно место предоставления</b>, если надо несколько справок в одно место писать кол-во штук. (Пример заявки если надо несколько штук: МФЦ – 2 шт).
                </p>
                <p>
                  <b>
                    <u>Заказ справки на работу родителю или студенту</u>
                  </b> – писать «на работу родителя» или «по месту трудоустройства» без названия организации.
                </p>
                <p>
                  <b>
                    <u>Заказ справки в гос. организации</u>
                  </b> – писать только название организации, запрещено писать в заявке для чего нужна справка и т.п. лишнюю информацию (пример заявки: ПФ). При необходимости отдельная заявка создается
                  <b>
                    <u>для заказа лицензии, аккредитации.</u>
                  </b>
                </p>
                <p>
                  <b>
                    <u>Заказ справки в военкомат</u>
                  </b> – писать название военкомата, район, округ, город, область (пример заявки: Военкомат Бутовского района ЮЗАО г. Москва).
                </p>
                <p>
                  <b>
                    <u>Гербовая печать на справке в военкомат</u>
                  </b> после получения справки в техникуме ставится студентом самостоятельно в РЭУ (Стремянный переулок, д. 36, 5 корп, 212 каб, с понедельника по пятницу с 8-30 до 17-00).
                </p>
                <p>«По месту требования» справки не оформляются.</p>
                <p>
                  Срок подготовки справок
                  <b>до 3 рабочих дней</b>, отсчет срока начинается со следующего рабочего дня (с понедельника по пятницу) после заказа справки.
                </p>
                <v-card-text
                  class="my-2 ma-0 pa-0 title"
                >Прием студентов ведется только по студенческому билету.</v-card-text>
                <p>
                  Получить справку можно с понедельника по пятницу в канцелярии техникума по адресу:
                  <b>ул. Нежинская, д. 7, кабинет 215 по расписанию работы со студентами:</b>
                </p>
                <p>
                  <b>с 10-00 до 10-10; с 11-40 до 12-00; с 13-30 до 14-00; с 15-30 до 15-40.</b>
                </p>
                <p>О готовности справки и об отказе приема заявки в работу уведомления отправляются на электронную почту студента, указанную в заявке, автоматически.</p>
                <p>Канцелярия не занимается подготовкой следующих документов:</p>
                <ul>
                  <li>
                    <p>
                      <b>
                        <u>Справка о периоде обучения (выписка оценок)</u>
                      </b> заказывается и получается:
                      1 курс – педагог организатор отделения (тел. 8-925-800-10-97);
                      2, 3, 4 курс – заведующий отделением Ключник Н.Е. (тел. 8-926-919-23-46, Нежинская ул., д.7, каб 223).
                    </p>
                  </li>
                  <li>
                    <p>
                      <b>
                        <u>Характеристика</u>
                      </b>, анкета для военкомата заказывается и получается: 1 курс – педагог организатор отделения (тел. 8-925-800-10-97); 2, 3, 4 курс – заведующий отделением Руденко Т.В. (тел. 8-495-800-12-00 доб. 2054, Нежинская ул., д.7, каб 242).
                    </p>
                  </li>
                  <li>
                    <p>
                      <b>
                        <u>Все справки с денежными суммами (о размере стипендии и т.п.), справка на субсидию</u>
                      </b> – в бухгалтерии (Стремянный пер, д. 36, 5 корп, кабинеты 304 и 308, тел. для бюджета 8-495-958-26-17, для договора 8-499-237-94-77).
                    </p>
                  </li>
                  <li>
                    <p>
                      <b>
                        <u>Копия аттестата</u>
                      </b> – в отделе по работе со студентами (Стремянный пер, д. 36, 3 корп, каб 100 (7 и 8 комн.) тел. 8-499-237-81-04).
                    </p>
                  </li>
                </ul>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="Surname" label="Фамилия" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="Firstname" label="Имя" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="Lastname" label="Отчество" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-select v-model="group" :items="itemsg" label="Группа" readonly></v-select>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="email" :rules="emailRules" label="E-mail" required readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field
                  v-model="datebirth"
                  label="Дата рождения"
                  hint="Формат День/Месяц/Год"
                  persistent-hint
                  @blur="date = parseDate(dateFormatted)"
                  readonly
                ></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-textarea
                  v-model="model"
                  :auto-grow="true"
                  :clearable="false"
                  :counter="255 ? 255 : false"
                  :filled="false"
                  :flat="true"
                  :hint="'Не более 255 символов'"
                  :label="'Текст заявки'"
                  :loading="false"
                  :no-resize="false"
                  :outlined="false"
                  :persistent-hint="false"
                  :placeholder="''"
                  :rounded="false"
                  :row-height="24"
                  :rows="3"
                  :shaped="false"
                  :single-line="false"
                  :solo="false"
                  :rules="orderRules"
                ></v-textarea>
              </v-row>
              <v-row class="pa-2">
                <v-checkbox
                  v-model="enabled"
                  hide-details
                  :rules="policyRules"
                  label="Отправляя заявку на справку подтверждаю, что с условиями заказа справок ознакомлен"
                  class="shrink mr-2 mt-0"
                ></v-checkbox>
              </v-row>
              <v-row class="pa-2 justify-center">
                <v-btn :disabled="!form" class="white--text" color="blue" depressed @click="sendQuery">Заказать</v-btn>
              </v-row>
            </v-container>
          </v-form>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data: () => ({
    model: "",
    itemsg: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    group: "П-2-16",
    // Surname: "Борисов",
    // Firstname: "Артём",
    // Lastname: "Игоревич",
    Surname: user.secName,
    Firstname: user.name,
    Lastname: user.thirdName,
    //email: "p_a.i.borisovmpt.ru";
    email: user.email,
    datebirth: "16-09-2000",
    enabled: false,
    orderRules: [
      v => v.length > 0 || "Текст заявки не указан",
      v => v.length <= 255 || "Текст заявки должен быть не более 255 символов"
    ],
    policyRules: [v => !!v || "Подтвердите!"],
    form: false
  }),
  methods: {
    sendQuery() {
      //Вписывай отправку
      alert("Go Nahui!");
    }
  },
  computed: {
    ...mapGetters({
      user: "user" 
    })
  }
};
</script>