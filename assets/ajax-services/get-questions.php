<?php

if(IsSet($_POST) && IsSet($_POST['questionId'])){
    $questionId = $_POST['questionId'];

    require_once '../utils/db_connect.php';
    require_once '../utils/queries/questions_queries.php';
    require_once '../utils/queries/answers_queries.php';

    $questionDetails = getQuestionsById($db, $questionId);

    echo json_encode($questionDetails);
    $db->close();
}
