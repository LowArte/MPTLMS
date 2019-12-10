(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[10],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _api_feedback__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../api/feedback */ "./resources/js/api/feedback.js");
/* harmony import */ var vue_the_mask__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-the-mask */ "./node_modules/vue-the-mask/dist/vue-the-mask.js");
/* harmony import */ var vue_the_mask__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue_the_mask__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _mixins_withSnackbar__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../mixins/withSnackbar */ "./resources/js/components/mixins/withSnackbar.js");
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
  mixins: [_mixins_withSnackbar__WEBPACK_IMPORTED_MODULE_2__["default"]],
  directives: {
    mask: vue_the_mask__WEBPACK_IMPORTED_MODULE_1__["mask"]
  },
  data: function data() {
    return {
      modelmessage: "",
      messageRules: [function (v) {
        return v.length > 0 || "Текст сообщения не указан";
      }, function (v) {
        return v.length <= 255 || "Текст сообщения должен быть не более 255 символов";
      }],
      form: false,
      search: "",
      mask: "####",
      expanded: [],
      singleExpand: true,
      page: 1,
      pageCount: 0,
      itemsPerPage: 100,
      headers: [{
        text: "Номер обращения",
        value: "id"
      }, {
        text: "Тематика",
        value: "name"
      }, {
        text: "Почта",
        value: "email"
      }, {
        text: "Дата обращения",
        value: "date"
      }, {
        text: "",
        value: "data-table-expand"
      }],
      items: []
    };
  },
  props: {
    requests: {
      data: String,
      "default": ""
    }
  },
  mounted: function mounted() {
    this.items = JSON.parse(this.requests);
    console.log(this.items);
  },
  methods: {
    sendQuery: function sendQuery(email) {
      var _this = this;

      _api_feedback__WEBPACK_IMPORTED_MODULE_0__["default"].sendEmail({
        mail: email,
        text: this.modelmessage,
        id: this.expanded[0].id
      }).then(function (res) {
        _this.showMessage("Ответ отправлен");

        _this.items.splice(_this.expanded[0]);
      })["catch"](function (exp) {
        _this.showError("Произошла ошибка");
      });
      this.modelmessage = "";
    },
    parseIntLoc: function parseIntLoc(val) {
      if (val == "" || val == null || val == "0") {
        return 1;
      }

      return parseInt(val);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=template&id=ae1cb7a2&lang=pug&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/pug-plain-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=template&id=ae1cb7a2&lang=pug& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************/
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
    { attrs: { align: "center", justify: "center" } },
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
                        staticClass: "mx-auto pa-4",
                        attrs: {
                          elevation: hover ? 12 : 2,
                          height: "auto",
                          width: "max"
                        }
                      },
                      [
                        _c("v-data-table", {
                          staticClass: "elevation-1",
                          attrs: {
                            headers: _vm.headers,
                            items: _vm.items,
                            "single-expand": true,
                            expanded: _vm.expanded,
                            "item-key": "id",
                            "show-expand": "",
                            page: _vm.page,
                            "hide-default-footer": "",
                            search: _vm.search,
                            "items-per-page": _vm.itemsPerPage
                          },
                          on: {
                            "update:expanded": function($event) {
                              _vm.expanded = $event
                            },
                            "update:page": function($event) {
                              _vm.page = $event
                            },
                            "page-count": function($event) {
                              _vm.pageCount = $event
                            }
                          },
                          scopedSlots: _vm._u(
                            [
                              {
                                key: "top",
                                fn: function() {
                                  return [
                                    _c(
                                      "div",
                                      [
                                        _c(
                                          "v-toolbar",
                                          {
                                            staticClass: "ma-0 ml-2 mr-2 pa-0",
                                            attrs: { flat: "", color: "white" }
                                          },
                                          [
                                            _c("v-toolbar-title", [
                                              _vm._v("Обращение пользователей")
                                            ]),
                                            _c("v-spacer")
                                          ],
                                          1
                                        ),
                                        _c(
                                          "v-card-title",
                                          {
                                            staticClass: "ma-0 ml-4 mr-4 pa-0"
                                          },
                                          [
                                            _c("v-text-field", {
                                              staticClass: "ma-0 pa-0",
                                              attrs: {
                                                label: "Поиск",
                                                "single-line": "",
                                                "hide-details": ""
                                              },
                                              model: {
                                                value: _vm.search,
                                                callback: function($$v) {
                                                  _vm.search = $$v
                                                },
                                                expression: "search"
                                              }
                                            })
                                          ],
                                          1
                                        )
                                      ],
                                      1
                                    )
                                  ]
                                },
                                proxy: true
                              },
                              {
                                key: "expanded-item",
                                fn: function(ref) {
                                  var headers = ref.headers
                                  return [
                                    _vm.expanded.length > 0
                                      ? _c(
                                          "td",
                                          {
                                            attrs: { colspan: headers.length }
                                          },
                                          [
                                            _c(
                                              "div",
                                              [
                                                _c(
                                                  "v-card-text",
                                                  {
                                                    staticClass:
                                                      "my-1 ma-0 pa-0 text"
                                                  },
                                                  [
                                                    _vm._v(
                                                      "ФИО: " +
                                                        _vm._s(
                                                          _vm.expanded[0].fio
                                                        )
                                                    )
                                                  ]
                                                ),
                                                _c(
                                                  "v-card-text",
                                                  {
                                                    staticClass:
                                                      "my-1 ma-0 pa-0 text"
                                                  },
                                                  [
                                                    _vm._v(
                                                      "Сообщение: " +
                                                        _vm._s(
                                                          _vm.expanded[0].body
                                                        )
                                                    )
                                                  ]
                                                ),
                                                _c("br"),
                                                _c(
                                                  "v-form",
                                                  {
                                                    staticClass: "mt-0 pt-0",
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
                                                      {
                                                        staticClass: "mt-0 pt-0"
                                                      },
                                                      [
                                                        _c(
                                                          "v-row",
                                                          {
                                                            staticClass:
                                                              "mt-0 pt-0"
                                                          },
                                                          [
                                                            _c("v-textarea", {
                                                              staticClass:
                                                                "mt-0 pt-0",
                                                              attrs: {
                                                                "auto-grow": true,
                                                                clearable: false,
                                                                counter: 255
                                                                  ? 255
                                                                  : undefined,
                                                                filled: false,
                                                                flat: true,
                                                                hint:
                                                                  "Не более 255 символов",
                                                                label:
                                                                  "Сообщение",
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
                                                                rules:
                                                                  _vm.messageRules
                                                              },
                                                              model: {
                                                                value:
                                                                  _vm.modelmessage,
                                                                callback: function(
                                                                  $$v
                                                                ) {
                                                                  _vm.modelmessage = $$v
                                                                },
                                                                expression:
                                                                  "modelmessage"
                                                              }
                                                            })
                                                          ],
                                                          1
                                                        ),
                                                        _c(
                                                          "v-row",
                                                          {
                                                            staticClass:
                                                              "pa-2 justify-center"
                                                          },
                                                          [
                                                            _c(
                                                              "v-btn",
                                                              {
                                                                staticClass:
                                                                  "white--text",
                                                                attrs: {
                                                                  disabled: !_vm.form,
                                                                  color: "blue",
                                                                  depressed: ""
                                                                },
                                                                on: {
                                                                  click: function(
                                                                    $event
                                                                  ) {
                                                                    return _vm.sendQuery(
                                                                      _vm
                                                                        .expanded[0]
                                                                        .email
                                                                    )
                                                                  }
                                                                }
                                                              },
                                                              [
                                                                _vm._v(
                                                                  "Отправить"
                                                                )
                                                              ]
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
                                        )
                                      : _vm._e()
                                  ]
                                }
                              }
                            ],
                            null,
                            true
                          )
                        }),
                        _c(
                          "div",
                          { staticClass: "text-center pt-2" },
                          [
                            _c("v-pagination", {
                              attrs: { length: _vm.pageCount },
                              model: {
                                value: _vm.page,
                                callback: function($$v) {
                                  _vm.page = $$v
                                },
                                expression: "page"
                              }
                            }),
                            _c("v-text-field", {
                              directives: [
                                {
                                  name: "mask",
                                  rawName: "v-mask",
                                  value: _vm.mask,
                                  expression: "mask"
                                }
                              ],
                              attrs: {
                                value: _vm.itemsPerPage,
                                label: "Количество отображаемых обращений"
                              },
                              on: {
                                input: function($event) {
                                  _vm.itemsPerPage = _vm.parseIntLoc($event)
                                }
                              }
                            })
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

/***/ "./resources/js/api/feedback.js":
/*!**************************************!*\
  !*** ./resources/js/api/feedback.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);

/* harmony default export */ __webpack_exports__["default"] = ({
  save: function save(credentials) {
    return axios__WEBPACK_IMPORTED_MODULE_0___default.a.post('/save_feedback', {
      "text": credentials.text,
      "type": credentials.type
    });
  },
  sendEmail: function sendEmail(credentials) {
    return axios__WEBPACK_IMPORTED_MODULE_0___default.a.post('/send_email', {
      "text": credentials.text,
      "to": credentials.mail,
      'id': credentials.id
    });
  }
});

/***/ }),

/***/ "./resources/js/components/feedback-f/RequestsUsersComponent.vue":
/*!***********************************************************************!*\
  !*** ./resources/js/components/feedback-f/RequestsUsersComponent.vue ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _RequestsUsersComponent_vue_vue_type_template_id_ae1cb7a2_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RequestsUsersComponent.vue?vue&type=template&id=ae1cb7a2&lang=pug& */ "./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=template&id=ae1cb7a2&lang=pug&");
/* harmony import */ var _RequestsUsersComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RequestsUsersComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _RequestsUsersComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _RequestsUsersComponent_vue_vue_type_template_id_ae1cb7a2_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"],
  _RequestsUsersComponent_vue_vue_type_template_id_ae1cb7a2_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/feedback-f/RequestsUsersComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestsUsersComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./RequestsUsersComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestsUsersComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=template&id=ae1cb7a2&lang=pug&":
/*!***************************************************************************************************************!*\
  !*** ./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=template&id=ae1cb7a2&lang=pug& ***!
  \***************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestsUsersComponent_vue_vue_type_template_id_ae1cb7a2_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/pug-plain-loader!../../../../node_modules/vue-loader/lib??vue-loader-options!./RequestsUsersComponent.vue?vue&type=template&id=ae1cb7a2&lang=pug& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/components/feedback-f/RequestsUsersComponent.vue?vue&type=template&id=ae1cb7a2&lang=pug&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestsUsersComponent_vue_vue_type_template_id_ae1cb7a2_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestsUsersComponent_vue_vue_type_template_id_ae1cb7a2_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);