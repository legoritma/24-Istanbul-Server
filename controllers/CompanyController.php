<?php
class CompanyController
{
    static public function display()
    {
        $params = array();
        $params['title'] = 'Company Subscription';
        $params['body'] = 'admin/add-company.php';
        $params['headerExtra'][] = 'google-map.php';
        $params['footerExtra'][] = 'tag-filter-script.php';

        getTemplate()->display('base.php', $params);
    }

    static public function companyForm()
    {
        $id = '24i' . md5(rand());
        getDatabase()->execute(
            'INSERT INTO venues(ID, Name, Latitude, Longitude, LastUpdateDate, Address) VALUES(:id, :name, :lat, :lng, :date, :address)',
            array(
                ':id' => $id,
                ':name' => $_POST['company'],
                ':lat' => $_POST['lat'],
                ':lng' => $_POST['lng'],
                ':date' => date('Y-m-d'),
                ':address' => $_POST['address'],
            )
        );

        foreach ($_POST['tag'] as $tag) {
            getDatabase()->execute(
                'INSERT INTO venue_meta(venueID, tagID) VALUES(:venueID, :tagID)',
                array(
                    ':venueID' => $id,
                    ':tagID' => $tag
                )
            );
        }

        getRoute()->redirect('/admin/personel-info.html');
    }
}

