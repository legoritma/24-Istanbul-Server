<?php
require_once 'lib/epiphany/Epi.php';
require_once 'api/Map.php';
require_once 'api/PlacesOfInterest.php';
require_once 'api/Question.php';
require_once 'api/Category.php';

include_once 'controllers/WelcomeController.php';
include_once 'controllers/AboutController.php';
include_once 'controllers/ContactController.php';
include_once 'controllers/CompanyController.php';
include_once 'controllers/PersonelController.php';
include_once 'controllers/PaymentController.php';

EPI::setPath('base', 'lib/epiphany');
Epi::setPath('view', 'views');
EPI::init('api', 'config', 'database', 'route', 'template', 'session');

// Configuration
getConfig()->load('./config/config.ini');
$db = getConfig()->get('db');
EpiDatabase::employ('mysql', $db->name, $db->host, $db->user, $db->pass);

// Routing
getRoute()->get('/', array('WelcomeController', 'display'));
getRoute()->get('/about.html', array('AboutController', 'display'));
getRoute()->get('/contact.html', array('ContactController', 'display'));

getRoute()->get('/api/map', array('Map', 'get'));

getRoute()->get('/api/poi/all.json', array('PlacesOfInterest', 'all'), EpiApi::external);
getRoute()->get('/api/poi/(\d+)/updated.json', array('PlacesOfInterest', 'updated'), EpiApi::external);

getRoute()->get('/api/question/all.json', array('Question', 'all'), EpiApi::external);
getRoute()->get('/api/question/(\d+)/updated.json', array('Question', 'updated'), EpiApi::external);

getRoute()->get('/api/category/all.json', array('Category', 'all'), EpiApi::external);
getRoute()->get('/api/category/(\d+)/updated.json', array('Category', 'updated'), EpiApi::external);

getRoute()->get('/admin/add-company.html', array('CompanyController', 'display'));
getRoute()->post('/admin/add-company.html', array('CompanyController', 'companyForm'));

getRoute()->get('/admin/personel-info.html', array('PersonelController', 'display'));
getRoute()->post('/admin/personel-info.html', array('PersonelController', 'personelForm'));

getRoute()->get('/admin/payment.html', array('PaymentController', 'display'));
getRoute()->post('/admin/payment.html', array('PaymentController', 'paymentForm'));
getRoute()->get('/admin/payment-success.html', array('PaymentController', 'displaySuccess'));

getRoute()->get('.*', 'error404', EpiApi::external);

getRoute()->run();

// Pages
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