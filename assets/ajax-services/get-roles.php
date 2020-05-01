<?php

if(IsSet($_GET)){

    require_once '../utils/db_connect.php';
    include '../utils/queries/roles_queries.php';

    $roles = getRoles($db);
    $result = array();
    foreach($roles as $role){
        $result[] = $role;
    }

    echo json_encode($result);

    $db->close();
}
