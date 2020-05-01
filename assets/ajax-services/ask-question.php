<?php

if(IsSet($_POST) && IsSet($_POST['title']) && IsSet($_POST['description']) && IsSet($_POST['user-id'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $userId = IsSet($_POST['user-id']);

    require_once '../utils/db_connect.php';
    require_once '../utils/queries/questions_queries.php';



    insertQuestions($db, $title, $description, $userId);
    $message = 'Question Posted Successfully';

    echo json_encode(['message' => $message]);
    http_response_code(200);

    $db->close();
    header("Location: ../../dashboard.php");

}
