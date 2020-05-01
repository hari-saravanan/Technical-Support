<?php

if(IsSet($_POST) && IsSet($_POST['username'])){
    $username = $_POST['username'];

    require_once '../utils/db_connect.php';
    require_once '../utils/queries/users_queries.php';

    $roleName = getRoleNameByUserId($db, $username);

    echo json_encode($roleName);
    $db->close();
}
