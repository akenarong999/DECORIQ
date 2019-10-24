
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
var $ = require('jquery');
import 'slick-carousel';

require('jquery-ui-bundle');


require('./bootstrap');

require('moment');
window.chart = require('chart.js');

window.swal = require('sweetalert2');


require('codemirror');
require('bs4-summernote/dist/summernote-bs4.css');
require('bs4-summernote');



require('gijgo');


require('popper.js');


window.FileUploadWithPreview = require('file-upload-with-preview');


require('jvectormap-next');

window.Vue = require('vue');


var dt = require( 'datatables.net' )();
import 'datatables.net-dt/css/jquery.dataTables.min.css';
import 'datatables.net-dt/css/dataTables.bootstrap4.min.css';




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

var _ = require('lodash');
