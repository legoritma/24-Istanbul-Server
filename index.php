<?php
include_once 'epiphany/Epi.php';
EPI::setPath('base', 'epiphany');
EPI::init('api');


// Routing
getRoute()->get('/', 'index');
getRoute()->run();


// Pages
function index() {
    echo 'Wellcome to 24-Istanbul';
}
