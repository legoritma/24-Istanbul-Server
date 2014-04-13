<?php

class Fetch
{
    public static function fetchme($sw, $ne, $step = 0.003)
    {
        // database
        set_time_limit(0);
        $ini_array = parse_ini_file("config/config.ini", true);
        $dbh = new PDO(
            'mysql:host=' . $ini_array['db']['host'] . ';dbname=' . $ini_array['db']['name'],
            $ini_array['db']['user'],
            $ini_array['db']['pass'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        $query_str = "INSERT INTO foursquare SET
            ID = :ID,
            Name = :Name,
            Latitude = :Latitude,
            Longitude = :Longitude,
            Address = :Address,
            category1 = :category1,
            category2 = :category2,
            category3 = :category3,
            checkinsCount = :checkinsCount,
            usersCount = :usersCount,
            tipCount = :tipCount";
        $sth = $dbh->prepare($query_str);

        //use https://api.foursquare.com/v2/venues/search?intent=browse&limit=50&sw=$sw&ne=$ne
        $clientId = $ini_array['foursquare']['id'];
        $clientSecret = $ini_array['foursquare']['secret'];
        $today = date("Ymd");
        $requestCount = 0;
        $prefix = "&client_id=${clientId}&client_secret=${clientSecret}&v=${today}";
        Fetch::time_elapsed(); // start timer
        for ($swTemp = $sw; $swTemp[0] < $ne[0]; $swTemp[0] += $step) {
            for (
                $tTemp = $swTemp, $neTemp = array($swTemp[0] + $step, $swTemp[1] + $step); // initialization
                $neTemp[1] < $ne[1]; // condition
                $tTemp[1] += $step, $neTemp[1] += $step // final-expression
            ) {
                $url = "https://api.foursquare.com/v2/venues/search?intent=browse&limit=50"
                        . "&sw=${tTemp[0]},${tTemp[1]}&ne=${neTemp[0]},${neTemp[1]}"
                        . $prefix;

                // Do cURL
                $cURL = curl_init();
                curl_setopt($cURL, CURLOPT_URL, $url);
                curl_setopt($cURL, CURLOPT_HTTPGET, true);
                curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($cURL);
                curl_close($cURL);

                // Decode JSON
                $json = json_decode($result, true);

                $pois = array();
                $count = count($json['response']['venues']);

                // Prepare for query
                foreach ($json['response']['venues'] as $key => $poi) {
                    $pois[] = array(
                        ':ID' => $poi['id'],
                        ':Name' => $poi['name'],
                        ':Latitude' => $poi['location']['lat'],
                        ':Longitude' => $poi['location']['lng'],
                        ':Address' => isset($poi['location']['address']) ? $poi['location']['address'] : null,
                        ':category1' => isset($poi['categories'][0]) ? $poi['categories'][0]['id'] : null,
                        ':category2' => isset($poi['categories'][1]) ? $poi['categories'][1]['id'] : null,
                        ':category3' => isset($poi['categories'][2]) ? $poi['categories'][2]['id'] : null,
                        ':checkinsCount' => $poi['stats']['checkinsCount'],
                        ':usersCount' => $poi['stats']['usersCount'],
                        ':tipCount' => $poi['stats']['tipCount'],
                    );
                }
                // Insert to DB
                foreach ($pois as $row) {
                    $sth->execute($row);
                }
                // keep log for debug
                file_put_contents(
                    'fetch.log',
                    "{count: ${count}, sw:[${tTemp[0]},${tTemp[1]}], ne:[${neTemp[0]},${neTemp[1]}], time:" .Fetch::time_elapsed() ."},". PHP_EOL,
                    FILE_APPEND
                );
                $requestCount++;
                echo ".";flush();
            }
        }
        file_put_contents('fetch.log', "request: ${requestCount}". PHP_EOL, FILE_APPEND);
    }

    public static function time_elapsed()
    {
        static $last = null;
        $now = microtime(true);
        if ($last != null) {
            return $now - $last;
        }
        $last = $now;
    }
}

Fetch::fetchme(
    array(40.9480, 28.9126),
    array(41.0928, 29.1666)
);
