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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(44);


/***/ }),

/***/ 44:
/***/ (function(module, exports) {

var $doctor = void 0,
    $date = void 0,
    $specialty = void 0,
    $hours = void 0,
    iradio = void 0;
$(function () {
    $specialty = $('#specialty');
    $doctor = $('#doctor');
    $date = $('#date');
    $hours = $('#hours');
    $specialty.change(function () {
        var specialtyId = $specialty.val();
        var url = '/specialties/' + specialtyId + '/doctors';
        $.getJSON(url, onDoctorsLoaded);
    });

    $doctor.change(loadHours);
    $date.change(loadHours);
});

function onDoctorsLoaded(doctors) {
    var htmlOptions = '';
    doctors.forEach(function (doctor) {
        htmlOptions += '<option value="' + doctor.id + '">' + doctor.name + '</option>';
    });

    $doctor.html(htmlOptions);
    loadHours();
}

function loadHours() {
    var selectedDate = $date.val();
    var doctorId = $doctor.val();
    var url = '/schedule/hours?date=' + selectedDate + '&doctor_id=' + doctorId;
    $.getJSON(url, displayHours);
}

function displayHours(data) {
    if (!data.MorningIntervals && !data.AfternoonIntervals) {
        var mesageAlert = alert('Lo sentimos', 'no se encontraron horas disponibles para el medico en el día selecionado');
        $hours.html(mesageAlert);
        return;
    }
    var htmlHours = "";
    iradio = 0;
    if (data.MorningIntervals) {
        data.MorningIntervals.forEach(function (interval) {
            htmlHours += getRadioIntervalHtml(interval);
        });
    }
    if (data.AfternoonIntervals) {
        data.AfternoonIntervals.forEach(function (interval) {
            htmlHours += getRadioIntervalHtml(interval);
        });
    }
    $hours.html(htmlHours);
}

function alert(mesageOne, mesageTwo) {
    var messajeAlert = '<div class="alert alert-danger" role="alert">\n        <strong> ' + mesageOne + '</strong> ' + mesageTwo + '\n    </div> ';

    return messajeAlert;
}

function getRadioIntervalHtml(interval) {
    var text = interval.start + ' - ' + interval.end;
    return '<div class="custom-control custom-radio mb-3">\n        <input type="radio" id="interval-' + iradio + '" value="' + interval.start + '" required name="scheduled_time"  class="custom-control-input">\n            <label class="custom-control-label" For="interval-' + iradio++ + '">' + text + '</label>\n    </div> ';
}

/***/ })

/******/ });