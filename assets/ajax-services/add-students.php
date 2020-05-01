<?php

if(IsSet($_POST) && IsSet($_POST['firstName']) && IsSet($_POST['firstName']) && IsSet($_POST['username'])
    && IsSet($_POST['roleId'])){

    require_once '../utils/db_connect.php';
    require_once '../utils/queries/users_queries.php';
    require_once '../utils/queries/roles_queries.php';
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $message = "";
    $roleId = $_POST['roleId'];
    $checkUsername = empty(findUser($db, $username));
        if(!$checkUsername){
            insertUser($db, $firstName, $lastName, $username, $username, $roleId);
            $message = "Success";
        } else {
            $message = "Register No Already Exist";
        }

    echo json_encode(['message' => $message]);
    http_response_code(200);

    $db->close();
}
