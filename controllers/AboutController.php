<?php
class AboutController
{
    static public function display()
    {
        $params = array();
        $params['title'] = '24 Istanbul - About';
        $params['body'][] = 'navbar.php';
        $params['body'][] = 'about.php';

        getTemplate()->display('base.php', $params);
    }
}