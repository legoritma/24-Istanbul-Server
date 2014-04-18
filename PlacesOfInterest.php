<?php

class PlacesOfInterest
{
    public static function all()
    {
        // return all poi
        return PlacesOfInterest::updated(null);
    }

    public static function updated($since)
    {
        if (is_null($since)) {
            $poiResults = getDatabase()->all('SELECT * FROM venues');
        } else {
            $poiResults = getDatabase()->all(
                'SELECT * FROM venues WHERE LastUpdateDate > :since',
                array(':since' => date('Y-m-d', $since))
            );
        }

        $pois = array();
        foreach ($poiResults as $poi) {
            $tagsResults = getDatabase()->all('SELECT * FROM venue_meta WHERE venueID = :id', array(':id' => $poi['ID']));
            $tags = array();
            foreach ($tagsResults as $tag) {
                $tags[] = intval($tag['tagID']);
            }
            $pois[] = array(
                'id'=> $poi['ID'],
                'name'=> $poi['Name'],
                'lat'=> floatval($poi['Latitude']),
                'lng'=> floatval($poi['Longitude']),
                'tags'=> $tags,
                'address'=> $poi['Address'],
                'update_date'=> $poi['LastUpdateDate']
            );
        }

        $all = array(
            'count' => count($pois),
            'pois' => $pois
        );

        return $all;
    }
}
