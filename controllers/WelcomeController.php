<?php
class WelcomeController
{
    static public function display()
    {
        $params = array();
        $params['title'] = 'Welcome to 24-Istanbul';
        $params['body'][] = 'navbar.php';
        $params['body'][] = 'welcome.php';

        getTemplate()->display('base.php', $params);
    }
}