<?php

class Category
{
    public static function all()
    {
        // return since the beginning of database
        return Category::updated(null);
    }

    public static function updated($since = null)
    {
        if (is_null($since)) {
            $categoriesResults = getDatabase()->all('SELECT * FROM categories');// all.json
        } else {
            $categoriesResults = getDatabase()->all('SELECT * FROM categories WHERE LastUpdateDate > :since', array(':since' => $since));
        }
        $categories = array();
        foreach($categoriesResults as $category){
            $tagsResults = getDatabase()->all('SELECT * FROM tags WHERE CategoryID = :id', array(':id' => $category['ID']));
            $tags = array();
            foreach($tagsResults as $tag){
                  $tags[] = $tag['ID'];
            }
            $categories[] = array(
                 'id' => $category['ID'],
                 'name' => $category['Name'],
                 'tags' => $tags,
                 'update_date' => $category['LastUpdateDate']
            );
            
        }
        
        $all = array(
           'count' => count($categories),
           'category' => $categories
        );
        
        return $all;
    }
}