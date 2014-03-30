<?php

class Question
{
    public static function all()
    {
        $questionsResults = getDatabase()->all('SELECT * FROM questions');
        $questions = array();
        foreach($questionsResults as $question)
        {
            $optionsResults = getDatabase()->all('SELECT * FROM options WHERE QuestionID = :id', array(':id' => $question['ID']));
            $options = array();
            foreach($optionsResults as $option)
            {
                  $options[] = array(
                      'id' => $option['ID'],
                      'text' => $option['Name'],
                      'tag' => $option['TagID']
                  );
            }
            $questions[] = array(
                 'id' => $question['ID'],
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

    public static function updated($since)
    {
        // return questions updated $since
    }
}