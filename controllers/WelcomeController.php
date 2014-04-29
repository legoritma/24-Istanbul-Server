<?php
class WelcomeController
{
    static public function display()
    {
        $params = array();
        $params['body'] = 'welcome.php';
        $params['title'] = 'Welcome to 24-Istanbul';

        getTemplate()->display('base.php', $params);
    }
}