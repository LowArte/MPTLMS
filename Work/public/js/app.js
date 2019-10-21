/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\resources\\js\\app.js: Unexpected token, expected \",\" (52:4)\n\n\u001b[0m \u001b[90m 50 | \u001b[39m    \u001b[32m'snackbar'\u001b[39m\u001b[33m:\u001b[39m \u001b[33mSnackBar\u001b[39m\u001b[33m,\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 51 | \u001b[39m    \u001b[32m'panel'\u001b[39m \u001b[33m:\u001b[39m \u001b[33mPanel\u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 52 | \u001b[39m    \u001b[32m'feadback'\u001b[39m \u001b[33m:\u001b[39m \u001b[33mFeadbackComponent\u001b[39m\u001b[33m,\u001b[39m \u001b[0m\n\u001b[0m \u001b[90m    | \u001b[39m    \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 53 | \u001b[39m    \u001b[32m'certificate'\u001b[39m \u001b[33m:\u001b[39m \u001b[33mCertificateComponent\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 54 | \u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 55 | \u001b[39m  }\u001b[33m,\u001b[39m\u001b[0m\n    at Parser.raise (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:6400:17)\n    at Parser.unexpected (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:7728:16)\n    at Parser.expect (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:7714:28)\n    at Parser.parseObj (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9249:14)\n    at Parser.parseExprAtom (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8883:28)\n    at Parser.parseExprSubscripts (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8507:23)\n    at Parser.parseMaybeUnary (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8487:21)\n    at Parser.parseExprOps (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8353:23)\n    at Parser.parseMaybeConditional (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8326:23)\n    at Parser.parseMaybeAssign (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8273:21)\n    at Parser.parseObjectProperty (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9380:101)\n    at Parser.parseObjPropValue (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9405:101)\n    at Parser.parseObjectMember (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9329:10)\n    at Parser.parseObj (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9253:25)\n    at Parser.parseExprAtom (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8883:28)\n    at Parser.parseExprSubscripts (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8507:23)\n    at Parser.parseMaybeUnary (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8487:21)\n    at Parser.parseExprOps (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8353:23)\n    at Parser.parseMaybeConditional (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8326:23)\n    at Parser.parseMaybeAssign (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8273:21)\n    at Parser.parseExprListItem (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9590:18)\n    at Parser.parseExprList (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9564:22)\n    at Parser.parseNewArguments (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9192:25)\n    at Parser.parseNew (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9186:10)\n    at Parser.parseExprAtom (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8900:21)\n    at Parser.parseExprSubscripts (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8507:23)\n    at Parser.parseMaybeUnary (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8487:21)\n    at Parser.parseExprOps (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8353:23)\n    at Parser.parseMaybeConditional (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8326:23)\n    at Parser.parseMaybeAssign (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8273:21)\n    at Parser.parseExpression (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:8221:23)\n    at Parser.parseStatementContent (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:10061:23)\n    at Parser.parseStatement (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9932:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:10508:25)\n    at Parser.parseBlockBody (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:10495:10)\n    at Parser.parseTopLevel (C:\\Users\\Artem\\Documents\\GitHub\\MPTLMS\\Work\\node_modules\\@babel\\parser\\lib\\index.js:9861:10)");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\Artem\Documents\GitHub\MPTLMS\Work\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\Users\Artem\Documents\GitHub\MPTLMS\Work\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });