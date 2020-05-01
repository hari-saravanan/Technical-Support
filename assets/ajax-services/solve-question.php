<?php

if(IsSet($_POST) &&IsSet($_POST['questionId'])){
    $questionId = IsSet($_POST['questionId']);#

    require_once '../utils/db_connect.php';
    include '../utils/queries/questions_queries.php';

    solvedQuestion($db, $questionId);
    $message = 'Question Solved Successfully';

    echo json_encode(['message' => $message]);
    http_response_code(200);

    $db->close();
}
