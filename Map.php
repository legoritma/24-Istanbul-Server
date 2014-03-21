<?php

class Map
{
    public static function get()
    {
        $map = getConfig()->get('map');
        getRoute()->redirect('/' . $map->dir . '/' . $map->file, 307);
    }
}