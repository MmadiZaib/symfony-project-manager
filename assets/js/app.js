import '../css/app.css'
import '../css/styles.css';


const $ = require('jquery');

require('bootstrap');

require('bootstrap/js/dist/tooltip');

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
