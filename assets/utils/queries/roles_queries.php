<?php

function createTableIfNeeded($db){
    $query = 'CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) DEFAULT NULL,
  `role_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)';
    $result = $db->query($query);
}

function getRoleByName($db, $name){
    $result = array();
    $query = 'SELECT id FROM roles WHERE UPPER(role_name) = ?';
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($result['id']);
    $stmt->fetch();
    $stmt->free_result();
    return $result;
}

function getRoles($db){
    $id = null;
    $name = null;
    $description = null;
    $result = array();
    $index = 0;
    $query = 'SELECT * FROM roles WHERE UPPER(role_name) NOT LIKE "%ADMIN%"';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $description);
    while($stmt->fetch()){
        $result[$index]['id'] = $id;
        $result[$index]['name'] = $name;
        $result[$index]['description'] = $description;
        $index += 1;
    }
    $stmt->free_result();
    return $result;
}

