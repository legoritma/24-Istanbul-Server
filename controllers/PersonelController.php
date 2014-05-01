<?php
class PersonelController
{
    static public function display()
    {
        $params = array();
        $params['title'] = 'Personel Details';
        $params['body'][] = 'navbar.php';
        $params['body'][] = 'admin/personel-info.php';

        getTemplate()->display('base.php', $params);
    }

    static public function personelForm()
    {
        var_dump($_POST);

        getRoute()->redirect('/admin/payment.html');
    }
}