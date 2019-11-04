(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[7],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Components_ConstructorReplacements__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Components/ConstructorReplacements */ "./resources/js/components/timetable/Components/ConstructorReplacements.vue");
/* harmony import */ var _Components_TeacherReplacements__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Components/TeacherReplacements */ "./resources/js/components/timetable/Components/TeacherReplacements.vue");
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
      tab: null,
      tabs: 2,
      tabitem: [{
        name: "Замены",
        com: _Components_TeacherReplacements__WEBPACK_IMPORTED_MODULE_1__["default"]
      }, {
        name: "Конструктор",
        com: _Components_ConstructorReplacements__WEBPACK_IMPORTED_MODULE_0__["default"]
      }]
    };
  },
  components: {
    Timetable: Timetable,
    Constructor: _Components_ConstructorReplacements__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=template&id=f5095c1a&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=template&id=f5095c1a& ***!
  \*************************************************************************************************************************************************************************************************************************************/
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
    "v-tabs",
    {
      attrs: { "background-color": "transparent", color: "basil", grow: "" },
      model: {
        value: _vm.tab,
        callback: function($$v) {
          _vm.tab = $$v
        },
        expression: "tab"
      }
    },
    [
      _c("v-tab", { key: _vm.item }, [_vm._v("Замены")]),
      _vm._v(" "),
      _c("v-tab", { key: _vm.item }, [_vm._v("Конструктор")]),
      _vm._v(" "),
      _c("v-tab-item", { key: _vm.item }, [_c("Replacements")], 1),
      _vm._v(" "),
      _c("v-tab-item", { key: _vm.item }, [_c("Constructor")], 1)
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/timetable/ConreplacementsComponent.vue":
/*!************************************************************************!*\
  !*** ./resources/js/components/timetable/ConreplacementsComponent.vue ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ConreplacementsComponent_vue_vue_type_template_id_f5095c1a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ConreplacementsComponent.vue?vue&type=template&id=f5095c1a& */ "./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=template&id=f5095c1a&");
/* harmony import */ var _ConreplacementsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ConreplacementsComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ConreplacementsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ConreplacementsComponent_vue_vue_type_template_id_f5095c1a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ConreplacementsComponent_vue_vue_type_template_id_f5095c1a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/timetable/ConreplacementsComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConreplacementsComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=template&id=f5095c1a&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=template&id=f5095c1a& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_template_id_f5095c1a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConreplacementsComponent.vue?vue&type=template&id=f5095c1a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/timetable/ConreplacementsComponent.vue?vue&type=template&id=f5095c1a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_template_id_f5095c1a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_template_id_f5095c1a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);