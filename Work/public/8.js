(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  data: function data() {
    return {
      items: [],
      z: []
    };
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=template&id=a1fefd82&":
/*!**************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=template&id=a1fefd82& ***!
  \**************************************************************************************************************************************************************************************************************************************************/
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
    "v-container",
    { attrs: { fluid: "" } },
    _vm._l(_vm.items, function(item) {
      return _c(
        "v-row",
        { key: item, attrs: { align: "center", justify: "center" } },
        [
          _c(
            "v-col",
            { attrs: { cols: "12" } },
            [
              _c("v-hover", {
                scopedSlots: _vm._u(
                  [
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
                                elevation: hover ? 10 : 5,
                                height: "auto",
                                width: "auto"
                              }
                            },
                            [
                              _c(
                                "v-card-title",
                                {
                                  staticClass: "subtitle-1",
                                  staticStyle: { color: "#FF3D00" }
                                },
                                [
                                  _vm._v(
                                    _vm._s(item.group) +
                                      " - " +
                                      _vm._s(item.date)
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-divider", { staticClass: "my-0" }),
                              _vm._v(" "),
                              _c("v-simple-table", [
                                _c("thead", [
                                  _c("tr", [
                                    _c("th", { staticClass: "text-left" }, [
                                      _vm._v("№")
                                    ]),
                                    _vm._v(" "),
                                    _c("th", { staticClass: "text-left" }, [
                                      _vm._v("Что заменяют")
                                    ]),
                                    _vm._v(" "),
                                    _c("th", { staticClass: "text-left" }, [
                                      _vm._v("На что заменяют")
                                    ]),
                                    _vm._v(" "),
                                    _c("th", { staticClass: "text-left" }, [
                                      _vm._v("Дата")
                                    ])
                                  ])
                                ]),
                                _vm._v(" "),
                                _c(
                                  "tbody",
                                  { attrs: { grow: "" } },
                                  _vm._l(_vm.z, function(z1) {
                                    return _c("tr", { key: z1.number }, [
                                      _c("td", [_vm._v(_vm._s(z1.number))]),
                                      _vm._v(" "),
                                      _c("td", [
                                        _vm._v(
                                          _vm._s(z1.original) +
                                            " (" +
                                            _vm._s(z1.originalt) +
                                            ")"
                                        )
                                      ]),
                                      _vm._v(" "),
                                      _c("td", [
                                        _vm._v(
                                          _vm._s(z1.newp) +
                                            " (" +
                                            _vm._s(z1.newpt) +
                                            ")"
                                        )
                                      ]),
                                      _vm._v(" "),
                                      _c("td", [_vm._v(_vm._s(z1.date))])
                                    ])
                                  }),
                                  0
                                )
                              ])
                            ],
                            1
                          )
                        ]
                      }
                    }
                  ],
                  null,
                  true
                )
              })
            ],
            1
          )
        ],
        1
      )
    }),
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/teachertimetable/Components/TeacherReplacements.vue":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/teachertimetable/Components/TeacherReplacements.vue ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TeacherReplacements_vue_vue_type_template_id_a1fefd82___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TeacherReplacements.vue?vue&type=template&id=a1fefd82& */ "./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=template&id=a1fefd82&");
/* harmony import */ var _TeacherReplacements_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TeacherReplacements.vue?vue&type=script&lang=js& */ "./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _TeacherReplacements_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TeacherReplacements_vue_vue_type_template_id_a1fefd82___WEBPACK_IMPORTED_MODULE_0__["render"],
  _TeacherReplacements_vue_vue_type_template_id_a1fefd82___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/teachertimetable/Components/TeacherReplacements.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TeacherReplacements_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TeacherReplacements.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TeacherReplacements_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=template&id=a1fefd82&":
/*!********************************************************************************************************************!*\
  !*** ./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=template&id=a1fefd82& ***!
  \********************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TeacherReplacements_vue_vue_type_template_id_a1fefd82___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TeacherReplacements.vue?vue&type=template&id=a1fefd82& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/teachertimetable/Components/TeacherReplacements.vue?vue&type=template&id=a1fefd82&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TeacherReplacements_vue_vue_type_template_id_a1fefd82___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TeacherReplacements_vue_vue_type_template_id_a1fefd82___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);