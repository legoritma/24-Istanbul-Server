<?php
class ContactController
{
    static public function display()
    {
        $params = array();
        $params['title'] = '24-Istanbul - Contact';
        $params['body'][] = 'navbar.php';
        $params['body'][] = 'contact.php';

        getTemplate()->display('base.php', $params);
    }
}