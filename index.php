<?php
include_once 'epiphany/Epi.php';
include_once 'Map.php';
include_once 'PlacesOfInterest.php';
include_once 'Question.php';

EPI::setPath('base', 'epiphany');
EPI::init('api', 'config', 'database', 'route');

// Configuration
getConfig()->load('./config/config.ini');
$db = getConfig()->get('db');
EpiDatabase::employ('mysql', $db->name, $db->host, $db->user, $db->pass);

// Routing
getRoute()->get('/', 'index');

getRoute()->get('/api/map', array('Map', 'get'));

getRoute()->get('/api/poi/all.json', array('PlacesOfInterest', 'all'), EpiApi::external);
getRoute()->get('/api/poi/(\d+)/updated.json', array('PlacesOfInterest', 'updated'), EpiApi::external);

getRoute()->get('/api/question/all.json', array('Question', 'all'), EpiApi::external);
getRoute()->get('/api/question/(\d+)/updated.json', array('Question', 'updated'), EpiApi::external);

getRoute()->get('/api/category/all.json', array('Category', 'all'), EpiApi::external);
getRoute()->get('/api/category/(\d+)/updated.json', array('Category', 'updated'), EpiApi::external);

getRoute()->run();

// Pages
function index() {
    echo 'Wellcome to 24-Istanbul';
}