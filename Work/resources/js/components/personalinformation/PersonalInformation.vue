<template>
  <v-row>
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-4" height="auto" width="max">
          <v-card-text class="my-1 ma-2 pa-0 display-1 font-weight-black">Персональная информация</v-card-text>
          <v-divider></v-divider>
          <v-row class="px-2 py-2" d-inline-flex>
            <v-list-item-content class="py-0" d-flex>
              <v-card-text class="px-5 py-0" d-flex>
                <v-avatar>
                  <img :src="require('../../assets/man.svg')" />
                </v-avatar>
              </v-card-text>
            </v-list-item-content>
            <v-list-item-content class="py-0" d-flex>
              <v-card-text class="headline title">Анпилогов Артём Олегович</v-card-text>
              <v-card-text class="px-5 py-0" d-flex>
                <v-chip>
                  <v-avatar>
                    <img :src="require('../../assets/school.svg')" />
                  </v-avatar>
                  <v-list-item-title
                    class="subtitle-1 px-1 py-1"
                  >Специальность: 09.02.03 Программирование в компьютерных системах</v-list-item-title>
                </v-chip>
              </v-card-text>
              <v-card-text class="px-5 py-0" d-flex>
                <v-chip>
                  <v-avatar>
                    <img :src="require('../../assets/group.svg')" />
                  </v-avatar>
                  <v-list-item-title class="subtitle-1 px-1 py-1">Группа: П-3-16</v-list-item-title>
                </v-chip>
              </v-card-text>
              <v-card-text class="px-5 py-0" d-flex>
                <v-chip>
                  <v-avatar>
                    <img :src="require('../../assets/chart.svg')" />
                  </v-avatar>
                  <v-list-item-title class="subtitle-1 px-1 py-1">Курс: 4</v-list-item-title>
                </v-chip>
              </v-card-text>
              <v-card-actions>
                <v-btn color="accent" dark>Сменить пароль</v-btn>
              </v-card-actions>
            </v-list-item-content>
          </v-row>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

/* <v-row>
    <v-col cols="12">
      <v-container fluid mx-0 px-0 py-0>
        <v-card-text class="py-1">
          <h2 class="font-weight-black">Персональная информация</h2>
        </v-card-text>
        <v-divider></v-divider>
        <v-card outlined style="border: none;" flat>
          <v-row class="px-2 py-2" d-inline-flex>
            <v-list-item-content class="px-3 py-1" d-flex>
              <v-list-item-title class="headline mb-1">
                <p class="title my-1">{{name}}</p>
              </v-list-item-title>
              <v-card-text class="px-0 py-0" d-flex>
                <v-chip>
                  <v-avatar>
                    <img :src="require('../../assets/school.svg')" />
                  </v-avatar>
                  <v-list-item-title >Специальность: {{education}}</v-list-item-title>
                </v-chip>
              </v-card-text>
              <v-card-text class="px-0 py-0" d-flex>
                <v-chip>
                  <v-avatar>
                    <img :src="require('../../assets/group.svg')" />
                  </v-avatar>
                  <v-list-item-title>Группа: {{group}}</v-list-item-title>
                </v-chip>
              </v-card-text>
              <v-card-text class="px-0 py-0" d-flex>
                <v-chip>
                  <v-avatar>
                    <img :src="require('../../assets/chart.svg')" />
                  </v-avatar>
                  <v-list-item-title >Курс: {{course}}</v-list-item-title>
                </v-chip>
              </v-card-text>
              <v-card-text class="px-0 py-2" d-flex>
                <p class="text-justify">О себе: {{about}}</p>
              </v-card-text>
            </v-list-item-content>
          </v-row>
        </v-card>
        <v-card-actions>
          <v-btn color="accent" dark>Сменить пароль</v-btn>
        </v-card-actions>
      </v-container>
      <v-divider></v-divider>
      <v-container fluid mx-0 px-0 py-0>
        <v-card flat>
          <v-card-title class="py-1">
            <h4 class="font-weight-black" py-0>Информация о себе</h4>
          </v-card-title>
          <v-card-text>
            <v-textarea
              outlined
              :rules="[(v) => v.length <= 255 || 'Max 255 characters']"
              :counter="255"
              auto-grow
            ></v-textarea>
          </v-card-text>
          <v-card-actions>
            <v-btn color="accent" dark>Сохранить изменения</v-btn>
          </v-card-actions>
        </v-card>
      </v-container>
    </v-col>
  </v-row> */