<?php
class PaymentController
{
    static public function display()
    {
        $params = array();
        $params['title'] = 'Payment';
        $params['body'] = 'admin/payment.php';

        getTemplate()->display('base.php', $params);
    }

    static public function paymentForm()
    {
        var_dump($_POST);

        getRoute()->redirect('/admin/payment-success.html');
    }

    static public function displaySuccess()
    {
        $params = array();
        $params['title'] = 'Payment Complete';
        $params['body'] = 'admin/payment-success.php';

        getTemplate()->display('base.php', $params);
    }
}