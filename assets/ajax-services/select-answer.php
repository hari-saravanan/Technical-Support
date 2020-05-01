<?php

if(IsSet($_POST) &&IsSet($_POST['answerId'])){
    $answerId = ($_POST['answerId']);

    require_once '../utils/db_connect.php';
    require_once '../utils/queries/answers_queries.php';

    selectAsAnswerByAnswerId($db, 1, $answerId);
    $message = 'Selected as answer Successfully';

    echo json_encode(['message' => $message]);
    http_response_code(200);

    $db->close();
}
