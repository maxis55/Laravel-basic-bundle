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

/***/ "./resources/admin/js/app.js":
/*!***********************************!*\
  !*** ./resources/admin/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var MyUploadAdapter =
/*#__PURE__*/
function () {
  function MyUploadAdapter(loader, url) {
    _classCallCheck(this, MyUploadAdapter);

    // Save Loader instance to update upload progress.
    this.loader = loader;
    this.url = url;
  }

  _createClass(MyUploadAdapter, [{
    key: "upload",
    value: function upload() {
      var _this = this;

      // Prepare the form data.
      return new Promise(function (resolve, reject) {
        _this._initRequest();

        _this._initListeners(resolve, reject);

        _this._sendRequest();
      });
    }
  }, {
    key: "abort",
    value: function abort() {
      if (this.xhr) {
        this.xhr.abort();
      }
    } // Initializes the XMLHttpRequest object using the URL passed to the constructor.

  }, {
    key: "_initRequest",
    value: function _initRequest() {
      var xhr = this.xhr = new XMLHttpRequest(); // Note that your request may look different. It is up to you and your editor
      // integration to choose the right communication channel. This example uses
      // the POST request with JSON as a data structure but your configuration
      // could be different.

      xhr.open('POST', this.url, true);
      xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
      xhr.responseType = 'json';
    } // Initializes XMLHttpRequest listeners.

  }, {
    key: "_initListeners",
    value: function _initListeners(resolve, reject) {
      var xhr = this.xhr;
      var loader = this.loader;
      var genericErrorText = 'Couldn\'t upload file:' + " ".concat(loader.file.name, ".");
      xhr.addEventListener('error', function () {
        return reject(genericErrorText);
      });
      xhr.addEventListener('abort', function () {
        return reject();
      });
      xhr.addEventListener('load', function () {
        var response = xhr.response; // This example assumes the XHR server's "response" object will come with
        // an "error" which has its own "message" that can be passed to reject()
        // in the upload promise.
        //
        // Your integration may handle upload errors in a different way so make sure
        // it is done properly. The reject() function must be called when the upload fails.

        if (!response || response.error) {
          return reject(response && response.error ? response.error.message : genericErrorText);
        } // If the upload is successful, resolve the upload promise with an object containing
        // at least the "default" URL, pointing to the image on the server.
        // This URL will be used to display the image in the content. Learn more in the
        // UploadAdapter#upload documentation.


        resolve({
          default: response.url
        });
      }); // Upload progress when it is supported. The FileLoader has the #uploadTotal and #uploaded
      // properties which are used e.g. to display the upload progress bar in the editor
      // user interface.

      if (xhr.upload) {
        xhr.upload.addEventListener('progress', function (evt) {
          if (evt.lengthComputable) {
            loader.uploadTotal = evt.total;
            loader.uploaded = evt.loaded;
          }
        });
      }
    } // Prepares the data and sends the request.

  }, {
    key: "_sendRequest",
    value: function _sendRequest() {
      // Prepare the form data.
      var data = new FormData();
      data.append('upload', this.loader.file); // Send the request.

      this.xhr.send(data);
    }
  }]);

  return MyUploadAdapter;
}();

function MyCustomUploadAdapterPlugin(editor) {
  editor.plugins.get('FileRepository').createUploadAdapter = function (loader) {
    // Configure the URL to the upload script in your back-end here!
    return new MyUploadAdapter(loader, '/admin/ajax/quick-file-upload');
  };
}

$(document).ready(function () {
  //ajax headers setup for ajax calls
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.each(document.querySelectorAll('.ckeditor'), function (index, value) {
    ClassicEditor.create(value, {
      extraPlugins: [MyCustomUploadAdapterPlugin]
    }).then().catch(function (error) {
      console.error(error);
    });
  });
  $('#is_free').on('change', function () {
    console.log($(this).val());

    if ($(this).val() == 0) {
      $('#delivery_cost').fadeIn();
    } else {
      $('#delivery_cost').fadeOut();
    }
  });
  $('.select2').select2({
    placeholder: 'Select'
  });
  var datatable_el = $('#datatable');

  if (datatable_el.length > 0) {
    var table = datatable_el.DataTable({
      serverSide: true,
      processing: true,
      responsive: true,
      "ajax": datatable_el.data('api_route'),
      "columns": datatable_el.data('columns_config')
    });
    $('.datatables_box').on('click', '.delete_element', function (e) {
      e.preventDefault();
      var curr_el = $(this);

      if (confirm(curr_el.data('confirmation'))) {
        $.ajax({
          url: curr_el.attr('href'),
          method: 'post',
          data: {
            _method: 'delete'
          },
          success: function success(result) {
            if (result === 'success') {
              table.ajax.reload(null, false);
            }
          }
        });
      } else {
        console.log('nothing');
      }
    });
  }

  $('form.dynamic_form').on('change', 'select.type_select', function (e) {
    $('.type_specific_block').hide().find('input').attr('disabled', true);
    $('.' + $(this).val() + '-block').show().find('input').attr('disabled', false);
  });
});
window.$ = window.jQuery = jQuery;

/***/ }),

/***/ 0:
/*!*****************************************!*\
  !*** multi ./resources/admin/js/app.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\OSPanel\domains\Laravel_Basic_Bundle\resources\admin\js\app.js */"./resources/admin/js/app.js");


/***/ })

/******/ });