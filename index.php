<?php
require_once 'lib/epiphany/Epi.php';
require_once 'api/Map.php';
require_once 'api/PlacesOfInterest.php';
require_once 'api/Question.php';
require_once 'api/Category.php';

EPI::setPath('base', 'lib/epiphany');
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

getRoute()->get('.*', 'error404', EpiApi::external);

getRoute()->run();

// Pages
function index()
{
    echo 'Welcome to 24-Istanbul';
}

function error404()
{
    return array(
        'error' => 'API not found',
        'availableApis' => array(
            '/api/map',
            '/api/poi/all.json',
            '/api/poi/{unix_time}/updated.json',
            '/api/question/all.json',
            '/api/question/{unix_time}/updated.json',
            '/api/category/all.json',
            '/api/category/{unix_time}/updated.json',
        )
    );
}