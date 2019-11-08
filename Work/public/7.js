(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[7],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Components_Certificate__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Components/Certificate */ "./resources/js/components/constructorreplacements/Components/Certificate.vue");
/* harmony import */ var _Components_Characteristic__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Components/Characteristic */ "./resources/js/components/constructorreplacements/Components/Characteristic.vue");
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
        name: "Справка",
        com: _Components_Certificate__WEBPACK_IMPORTED_MODULE_0__["default"]
      }, {
        name: "Характеристика",
        com: _Components_Characteristic__WEBPACK_IMPORTED_MODULE_1__["default"]
      }]
    };
  },
  components: {
    OrderCharacteristic: _Components_Characteristic__WEBPACK_IMPORTED_MODULE_1__["default"],
    OrderCertificate: _Components_Certificate__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=template&id=22cc1b0e&":
/*!***************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=template&id=22cc1b0e& ***!
  \***************************************************************************************************************************************************************************************************************************************************/
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
      _c("v-tab", { key: _vm.item }, [_vm._v("Справка")]),
      _vm._v(" "),
      _c("v-tab", { key: _vm.item }, [_vm._v("Характеристика")]),
      _vm._v(" "),
      _c("v-tab-item", { key: _vm.item }, [_c("OrderCertificate")], 1),
      _vm._v(" "),
      _c("v-tab-item", { key: _vm.item }, [_c("OrderCharacteristic")], 1)
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/constructorreplacements/ConreplacementsComponent.vue":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/constructorreplacements/ConreplacementsComponent.vue ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ConreplacementsComponent_vue_vue_type_template_id_22cc1b0e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ConreplacementsComponent.vue?vue&type=template&id=22cc1b0e& */ "./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=template&id=22cc1b0e&");
/* harmony import */ var _ConreplacementsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ConreplacementsComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ConreplacementsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ConreplacementsComponent_vue_vue_type_template_id_22cc1b0e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ConreplacementsComponent_vue_vue_type_template_id_22cc1b0e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/constructorreplacements/ConreplacementsComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************!*\
  !*** ./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConreplacementsComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=template&id=22cc1b0e&":
/*!*********************************************************************************************************************!*\
  !*** ./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=template&id=22cc1b0e& ***!
  \*********************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_template_id_22cc1b0e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConreplacementsComponent.vue?vue&type=template&id=22cc1b0e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/constructorreplacements/ConreplacementsComponent.vue?vue&type=template&id=22cc1b0e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_template_id_22cc1b0e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConreplacementsComponent_vue_vue_type_template_id_22cc1b0e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);