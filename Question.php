<?php

class Question
{
    public static function all()
    {
        // return since the beginning of database
        return Question::updated(null);
    }

    public static function updated($since)
    {
        $since=date("Y-m-d",$since);
        $questionsResults = getDatabase()->all('SELECT * FROM questions WHERE LastUpdateDate > :since', array(':since' => $since));
        $questions = array();
        foreach($questionsResults as $question){
            $optionsResults = getDatabase()->all('SELECT * FROM options WHERE QuestionID = :id', array(':id' => $question['ID']));
            $options = array();
            foreach($optionsResults as $option){
                  $options[] = array(
                      'id' => intval($option['ID']),
                      'text' => $option['Name'],
                      'tag' => (isset($option['TagID']) ? intval($option['TagID']) : -1)
                  );
            }
            $questions[] = array(
                 'id' => intval($question['ID']),
                 'category' => intval($question['CategoryID']),
                 'question' => $question['Question'],
                 'options' => $options,
                 'update_date' => $question['LastUpdateDate']
            );
            
        }
        
        $all = array(
           'count' => count($questions),
           'question' => $questions
        );
        
        return $all;
    }
}