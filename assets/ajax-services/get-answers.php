<?php

if(IsSet($_POST) && IsSet($_POST['questionId'])){

    $questionId = IsSet($_POST['questionId']);

    require_once '../utils/db_connect.php';
    include '../utils/queries/answers_queries.php';

    $answers = getAnswerByQuestionId($db, $questionId);
    $result = array();
    foreach($answers as $answer){
        $result[] = $answer;
    }

    echo json_encode($result);

    $db->close();
}
