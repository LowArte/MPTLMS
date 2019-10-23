(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/personalinformation/PersonalInformation.vue?vue&type=template&id=2c78cc0e&":
/*!******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/personalinformation/PersonalInformation.vue?vue&type=template&id=2c78cc0e& ***!
  \******************************************************************************************************************************************************************************************************************************************/
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
          _c(
            "v-container",
            { attrs: { fluid: "", "mx-0": "", "px-0": "", "py-0": "" } },
            [
              _c("v-card-text", { staticClass: "py-1" }, [
                _c("h2", { staticClass: "font-weight-black" }, [
                  _vm._v("Персональная информация")
                ])
              ]),
              _vm._v(" "),
              _c("v-divider"),
              _vm._v(" "),
              _c(
                "v-card",
                {
                  staticStyle: { border: "none" },
                  attrs: { outlined: "", flat: "" }
                },
                [
                  _c(
                    "v-row",
                    {
                      staticClass: "px-2 py-2",
                      attrs: { "d-inline-flex": "" }
                    },
                    [
                      _c(
                        "v-list-item-content",
                        { staticClass: "px-3 py-1", attrs: { "d-flex": "" } },
                        [
                          _c(
                            "v-list-item-title",
                            { staticClass: "headline mb-1" },
                            [
                              _c("p", { staticClass: "title my-1" }, [
                                _vm._v(_vm._s(_vm.name))
                              ])
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "v-card-text",
                            {
                              staticClass: "px-0 py-0",
                              attrs: { "d-flex": "" }
                            },
                            [
                              _c(
                                "v-chip",
                                [
                                  _c("v-avatar", [
                                    _c("img", {
                                      attrs: {
                                        src: __webpack_require__(/*! ../../assets/school.svg */ "./resources/js/assets/school.svg")
                                      }
                                    })
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "v-list-item-title",
                                    { staticClass: "red--text headline mx-2" },
                                    [
                                      _vm._v(
                                        "Специальность: " +
                                          _vm._s(_vm.education)
                                      )
                                    ]
                                  )
                                ],
                                1
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "v-card-text",
                            {
                              staticClass: "px-0 py-0",
                              attrs: { "d-flex": "" }
                            },
                            [
                              _c(
                                "v-chip",
                                [
                                  _c("v-avatar", [
                                    _c("img", {
                                      attrs: {
                                        src: __webpack_require__(/*! ../../assets/group.svg */ "./resources/js/assets/group.svg")
                                      }
                                    })
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "v-list-item-title",
                                    { staticClass: "red--text headline mx-2" },
                                    [_vm._v("Группа: " + _vm._s(_vm.group))]
                                  )
                                ],
                                1
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "v-card-text",
                            {
                              staticClass: "px-0 py-0",
                              attrs: { "d-flex": "" }
                            },
                            [
                              _c(
                                "v-chip",
                                [
                                  _c("v-avatar", [
                                    _c("img", {
                                      attrs: {
                                        src: __webpack_require__(/*! ../../assets/chart.svg */ "./resources/js/assets/chart.svg")
                                      }
                                    })
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "v-list-item-title",
                                    { staticClass: "red--text headline mx-2" },
                                    [_vm._v("Курс: " + _vm._s(_vm.course))]
                                  )
                                ],
                                1
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "v-card-text",
                            {
                              staticClass: "px-0 py-2",
                              attrs: { "d-flex": "" }
                            },
                            [
                              _c("p", { staticClass: "text-justify" }, [
                                _vm._v("О себе: " + _vm._s(_vm.about))
                              ])
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
              ),
              _vm._v(" "),
              _c(
                "v-card-actions",
                [
                  _c("v-btn", { attrs: { color: "accent", dark: "" } }, [
                    _vm._v("Сменить пароль")
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("v-divider"),
          _vm._v(" "),
          _c(
            "v-container",
            { attrs: { fluid: "", "mx-0": "", "px-0": "", "py-0": "" } },
            [
              _c(
                "v-card",
                { attrs: { flat: "" } },
                [
                  _c("v-card-title", { staticClass: "py-1" }, [
                    _c(
                      "h4",
                      {
                        staticClass: "font-weight-black",
                        attrs: { "py-0": "" }
                      },
                      [_vm._v("Информация о себе")]
                    )
                  ]),
                  _vm._v(" "),
                  _c(
                    "v-card-text",
                    [
                      _c("v-textarea", {
                        attrs: {
                          outlined: "",
                          rules: [
                            function(v) {
                              return v.length <= 255 || "Max 255 characters"
                            }
                          ],
                          counter: 255,
                          "auto-grow": ""
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "v-card-actions",
                    [
                      _c("v-btn", { attrs: { color: "accent", dark: "" } }, [
                        _vm._v("Сохранить изменения")
                      ])
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
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/assets/chart.svg":
/*!***************************************!*\
  !*** ./resources/js/assets/chart.svg ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/chart.svg?bd09df7aec42abfe871bc9149aa027cf";

/***/ }),

/***/ "./resources/js/assets/group.svg":
/*!***************************************!*\
  !*** ./resources/js/assets/group.svg ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/group.svg?b38ace64ed9de1b443237d723388ad18";

/***/ }),

/***/ "./resources/js/assets/school.svg":
/*!****************************************!*\
  !*** ./resources/js/assets/school.svg ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/school.svg?f8051b701ad5f7645501503dad68f1e8";

/***/ }),

/***/ "./resources/js/components/personalinformation/PersonalInformation.vue":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/personalinformation/PersonalInformation.vue ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PersonalInformation_vue_vue_type_template_id_2c78cc0e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PersonalInformation.vue?vue&type=template&id=2c78cc0e& */ "./resources/js/components/personalinformation/PersonalInformation.vue?vue&type=template&id=2c78cc0e&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");

var script = {}


/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  script,
  _PersonalInformation_vue_vue_type_template_id_2c78cc0e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PersonalInformation_vue_vue_type_template_id_2c78cc0e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/personalinformation/PersonalInformation.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/personalinformation/PersonalInformation.vue?vue&type=template&id=2c78cc0e&":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/personalinformation/PersonalInformation.vue?vue&type=template&id=2c78cc0e& ***!
  \************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PersonalInformation_vue_vue_type_template_id_2c78cc0e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./PersonalInformation.vue?vue&type=template&id=2c78cc0e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/personalinformation/PersonalInformation.vue?vue&type=template&id=2c78cc0e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PersonalInformation_vue_vue_type_template_id_2c78cc0e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PersonalInformation_vue_vue_type_template_id_2c78cc0e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);