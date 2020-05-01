<?php

if(IsSet($_POST) && IsSet($_POST['name']) && IsSet($_POST['questionId']) && IsSet($_POST['answeredBy'])){
    $questionId = IsSet($_POST['questionId']);
    $text = ($_POST['name']);
    $answeredBy = IsSet($_POST['answeredBy']);

    require_once '../utils/db_connect.php';
    include '../utils/queries/answers_queries.php';

    addAnswers($db, $questionId, $text, $answeredBy);
    $message = 'Answer Added Successfully';

    echo json_encode(['message' => $message]);
    http_response_code(200);

    $db->close();

}
