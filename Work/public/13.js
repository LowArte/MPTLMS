(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[13],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _utils_dataFormater__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../utils/dataFormater */ "./resources/js/utils/dataFormater.js");
/* harmony import */ var _api_certificate__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../api/certificate */ "./resources/js/api/certificate.js");
/* harmony import */ var _mixins_withSnackbar__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../mixins/withSnackbar */ "./resources/js/components/mixins/withSnackbar.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
  mixins: [_mixins_withSnackbar__WEBPACK_IMPORTED_MODULE_3__["default"]],
  data: function data() {
    return {
      model: "",
      group: "",
      FIO: user.secName + " " + user.name + " " + user.thirdName,
      email: user.email,
      datebirth: "",
      enabled: false,
      orderRules: [function (v) {
        return v.length > 0 || "Текст заявки не указан";
      }, function (v) {
        return v.length <= 255 || "Текст заявки должен быть не более 255 символов";
      }],
      policyRules: [function (v) {
        return !!v || "Подтвердите!";
      }],
      form: false
    };
  },
  methods: {
    sendQuery: function sendQuery() {
      var _this = this;

      _api_certificate__WEBPACK_IMPORTED_MODULE_2__["default"].save({
        data: this.model,
        type: "Справка"
      }).then(function (res) {
        _this.showMessage("Справка отправленна");

        _this.cleardata();
      })["catch"](function (exp) {
        _this.showError("Произошла ошибка");

        _this.cleardata();
      });
    },
    cleardata: function cleardata() {
      this.model = "";
    }
  },
  mounted: function mounted() {
    var info = JSON.parse(this.info);
    this.datebirth = Object(_utils_dataFormater__WEBPACK_IMPORTED_MODULE_1__["default"])(new Date(info.student.birthday));
    this.group = info.group.group_name;
  },
  props: {
    info: {
      data: String,
      "default": null
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=template&id=66f00488&":
/*!*****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=template&id=66f00488& ***!
  \*****************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-row",
    [
      _c(
        "v-col",
        { attrs: { cols: "12" } },
        [
          _c("v-hover", {
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(ref) {
                  var hover = ref.hover
                  return [
                    _c(
                      "v-card",
                      {
                        staticClass: "mx-auto",
                        attrs: {
                          elevation: hover ? 12 : 2,
                          height: "auto",
                          width: "max"
                        }
                      },
                      [
                        _c(
                          "v-form",
                          {
                            model: {
                              value: _vm.form,
                              callback: function($$v) {
                                _vm.form = $$v
                              },
                              expression: "form"
                            }
                          },
                          [
                            _c(
                              "v-container",
                              [
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2" },
                                  [
                                    _c(
                                      "v-card-text",
                                      {
                                        staticClass:
                                          "my-2 ma-0 pa-0 text-center title"
                                      },
                                      [
                                        _vm._v(
                                          "Канцелярия подготавливает только документы, подтверждающие факт обучения в техникуме обучающихся в настоящее время студентов техникума."
                                        )
                                      ]
                                    )
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2" },
                                  [
                                    _c("p", [
                                      _c("b", [
                                        _vm._v(
                                          "1 заявка = 1 справка в одно место предоставления"
                                        )
                                      ]),
                                      _vm._v(
                                        ", если надо несколько справок в одно место писать кол-во штук. (Пример заявки если надо несколько штук: МФЦ – 2 шт).\n              "
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _c("b", [
                                        _c("u", [
                                          _vm._v(
                                            "Заказ справки на работу родителю или студенту"
                                          )
                                        ])
                                      ]),
                                      _vm._v(
                                        " – писать «на работу родителя» или «по месту трудоустройства» без названия организации.\n              "
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _c("b", [
                                        _c("u", [
                                          _vm._v(
                                            "Заказ справки в гос. организации"
                                          )
                                        ])
                                      ]),
                                      _vm._v(
                                        " – писать только название организации, запрещено писать в заявке для чего нужна справка и т.п. лишнюю информацию (пример заявки: ПФ). При необходимости отдельная заявка создается\n                "
                                      ),
                                      _c("b", [
                                        _c("u", [
                                          _vm._v(
                                            "для заказа лицензии, аккредитации."
                                          )
                                        ])
                                      ])
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _c("b", [
                                        _c("u", [
                                          _vm._v("Заказ справки в военкомат")
                                        ])
                                      ]),
                                      _vm._v(
                                        " – писать название военкомата, район, округ, город, область (пример заявки: Военкомат Бутовского района ЮЗАО г. Москва).\n              "
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _c("b", [
                                        _c("u", [
                                          _vm._v(
                                            "Гербовая печать на справке в военкомат"
                                          )
                                        ])
                                      ]),
                                      _vm._v(
                                        " после получения справки в техникуме ставится студентом самостоятельно в РЭУ (Стремянный переулок, д. 36, 5 корп, 212 каб, с понедельника по пятницу с 8-30 до 17-00).\n              "
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _vm._v(
                                        "«По месту требования» справки не оформляются."
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _vm._v(
                                        "\n                Срок подготовки справок\n                "
                                      ),
                                      _c("b", [_vm._v("до 3 рабочих дней")]),
                                      _vm._v(
                                        ", отсчет срока начинается со следующего рабочего дня (с понедельника по пятницу) после заказа справки.\n              "
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c(
                                      "v-card-text",
                                      { staticClass: "my-2 ma-0 pa-0 title" },
                                      [
                                        _vm._v(
                                          "Прием студентов ведется только по студенческому билету."
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("p", [
                                      _vm._v(
                                        "\n                Получить справку можно с понедельника по пятницу в канцелярии техникума по адресу:\n                "
                                      ),
                                      _c("b", [
                                        _vm._v(
                                          "ул. Нежинская, д. 7, кабинет 215 по расписанию работы со студентами:"
                                        )
                                      ])
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _c("b", [
                                        _vm._v(
                                          "с 10-00 до 10-10; с 11-40 до 12-00; с 13-30 до 14-00; с 15-30 до 15-40."
                                        )
                                      ])
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _vm._v(
                                        "О готовности справки и об отказе приема заявки в работу уведомления отправляются на электронную почту студента, указанную в заявке, автоматически."
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c("p", [
                                      _vm._v(
                                        "Канцелярия не занимается подготовкой следующих документов:"
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c("ul", [
                                      _c("li", [
                                        _c("p", [
                                          _c("b", [
                                            _c("u", [
                                              _vm._v(
                                                "Справка о периоде обучения (выписка оценок)"
                                              )
                                            ])
                                          ]),
                                          _vm._v(
                                            " заказывается и получается:\n                    1 курс – педагог организатор отделения (тел. 8-925-800-10-97);\n                    2, 3, 4 курс – заведующий отделением Ключник Н.Е. (тел. 8-926-919-23-46, Нежинская ул., д.7, каб 223).\n                  "
                                          )
                                        ])
                                      ]),
                                      _vm._v(" "),
                                      _c("li", [
                                        _c("p", [
                                          _c("b", [
                                            _c("u", [_vm._v("Характеристика")])
                                          ]),
                                          _vm._v(
                                            ", анкета для военкомата заказывается и получается: 1 курс – педагог организатор отделения (тел. 8-925-800-10-97); 2, 3, 4 курс – заведующий отделением Руденко Т.В. (тел. 8-495-800-12-00 доб. 2054, Нежинская ул., д.7, каб 242).\n                  "
                                          )
                                        ])
                                      ]),
                                      _vm._v(" "),
                                      _c("li", [
                                        _c("p", [
                                          _c("b", [
                                            _c("u", [
                                              _vm._v(
                                                "Все справки с денежными суммами (о размере стипендии и т.п.), справка на субсидию"
                                              )
                                            ])
                                          ]),
                                          _vm._v(
                                            " – в бухгалтерии (Стремянный пер, д. 36, 5 корп, кабинеты 304 и 308, тел. для бюджета 8-495-958-26-17, для договора 8-499-237-94-77).\n                  "
                                          )
                                        ])
                                      ]),
                                      _vm._v(" "),
                                      _c("li", [
                                        _c("p", [
                                          _c("b", [
                                            _c("u", [_vm._v("Копия аттестата")])
                                          ]),
                                          _vm._v(
                                            " – в отделе по работе со студентами (Стремянный пер, д. 36, 3 корп, каб 100 (7 и 8 комн.) тел. 8-499-237-81-04).\n                  "
                                          )
                                        ])
                                      ])
                                    ])
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2" },
                                  [
                                    _c("v-text-field", {
                                      attrs: {
                                        label:
                                          "Фамилия, Имя, Отчество студента",
                                        readonly: ""
                                      },
                                      model: {
                                        value: _vm.FIO,
                                        callback: function($$v) {
                                          _vm.FIO = $$v
                                        },
                                        expression: "FIO"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2" },
                                  [
                                    _c("v-text-field", {
                                      attrs: { label: "Группа", readonly: "" },
                                      model: {
                                        value: _vm.group,
                                        callback: function($$v) {
                                          _vm.group = $$v
                                        },
                                        expression: "group"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2" },
                                  [
                                    _c("v-text-field", {
                                      attrs: {
                                        label: "E-mail",
                                        required: "",
                                        readonly: ""
                                      },
                                      model: {
                                        value: _vm.email,
                                        callback: function($$v) {
                                          _vm.email = $$v
                                        },
                                        expression: "email"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2" },
                                  [
                                    _c("v-text-field", {
                                      attrs: {
                                        label: "Дата рождения",
                                        readonly: ""
                                      },
                                      model: {
                                        value: _vm.datebirth,
                                        callback: function($$v) {
                                          _vm.datebirth = $$v
                                        },
                                        expression: "datebirth"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2" },
                                  [
                                    _c("v-textarea", {
                                      attrs: {
                                        "auto-grow": true,
                                        clearable: false,
                                        counter: 255 ? 255 : undefined,
                                        filled: false,
                                        flat: true,
                                        hint: "Не более 255 символов",
                                        label: "Текст заявки",
                                        loading: false,
                                        "no-resize": false,
                                        outlined: false,
                                        "persistent-hint": false,
                                        placeholder: "",
                                        rounded: false,
                                        "row-height": 24,
                                        rows: 3,
                                        shaped: false,
                                        "single-line": false,
                                        solo: false,
                                        rules: _vm.orderRules
                                      },
                                      model: {
                                        value: _vm.model,
                                        callback: function($$v) {
                                          _vm.model = $$v
                                        },
                                        expression: "model"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2" },
                                  [
                                    _c("v-switch", {
                                      staticClass: "shrink mr-2 mt-0",
                                      attrs: {
                                        color: "primary",
                                        value: "primary",
                                        rules: _vm.policyRules,
                                        inset: "",
                                        label:
                                          "Отправляя заявку на справку подтверждаю, что с условиями заказа справок ознакомлен"
                                      },
                                      model: {
                                        value: _vm.enabled,
                                        callback: function($$v) {
                                          _vm.enabled = $$v
                                        },
                                        expression: "enabled"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-row",
                                  { staticClass: "pa-2 justify-center" },
                                  [
                                    _c(
                                      "v-btn",
                                      {
                                        staticClass: "white--text",
                                        attrs: {
                                          disabled: !_vm.form,
                                          color: "blue",
                                          depressed: ""
                                        },
                                        on: { click: _vm.sendQuery }
                                      },
                                      [_vm._v("Заказать")]
                                    )
                                  ],
                                  1
                                )
                              ],
                              1
                            )
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ]
                }
              }
            ])
          })
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/certificate/Components/ViewCertificate.vue":
/*!****************************************************************************!*\
  !*** ./resources/js/components/certificate/Components/ViewCertificate.vue ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ViewCertificate_vue_vue_type_template_id_66f00488___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ViewCertificate.vue?vue&type=template&id=66f00488& */ "./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=template&id=66f00488&");
/* harmony import */ var _ViewCertificate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ViewCertificate.vue?vue&type=script&lang=js& */ "./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ViewCertificate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ViewCertificate_vue_vue_type_template_id_66f00488___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ViewCertificate_vue_vue_type_template_id_66f00488___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/certificate/Components/ViewCertificate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ViewCertificate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ViewCertificate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ViewCertificate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=template&id=66f00488&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=template&id=66f00488& ***!
  \***********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ViewCertificate_vue_vue_type_template_id_66f00488___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ViewCertificate.vue?vue&type=template&id=66f00488& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/certificate/Components/ViewCertificate.vue?vue&type=template&id=66f00488&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ViewCertificate_vue_vue_type_template_id_66f00488___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ViewCertificate_vue_vue_type_template_id_66f00488___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);