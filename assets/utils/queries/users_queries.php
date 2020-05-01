<?php
    function createUsersTable($db) {
        $query = "CREATE TABLE IF NOT EXISTS `users` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `first_name` varchar(100) DEFAULT NULL,
                  `last_name` varchar(100) DEFAULT NULL,
                  `username` varchar(100) DEFAULT NULL,
                  `password` varchar(100) DEFAULT NULL,
                  `active` tinyint(1) DEFAULT NULL,
                  `role_id` int(11) NOT NULL,
                  `is_admin` tinyint(1) DEFAULT '0',
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `users_un` (`username`),
                  KEY `users_fk` (`role_id`),
                  CONSTRAINT `users_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
                )";
        $result = $db->query($query);
    }

    function userLogin($db, $username, $password) {
        $return = array();
        $query = "SELECT id, is_admin FROM users WHERE username = ? and password = ?";
        $stmt = $db->prepare($query);
        //Prepared statement, string only
        $hashedPassword = sha1($password);
        $stmt->bind_param('ss', $username, $hashedPassword);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($return['id'], $return['is_admin']);
        $stmt->fetch();
        $stmt->free_result();
        return $return;
    }

    function findUser($db, $username) {
        $result = array();
        $query = "SELECT username FROM users WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($result['username']);
        $stmt->fetch();
        $stmt->free_result();
        return $result;
    }

    function getRoleNameByUserId($db, $username){
        $result = array();
        $query = "SELECT r.role_name FROM users u
                    JOIN roles r ON r.id = u.role_id WHERE u.username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($result['roleName']);
        $stmt->fetch();
        $stmt->free_result();
        return $result;
    }

    function insertUser($db, $firstName, $lastName, $username, $password, $role_id) {
        $query = "INSERT INTO users (first_name, last_name, username, password, role_id) VALUES (?, ?, ?, ?, ?)";
        $hashedPassword = sha1($password);
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssssi', $firstName, $lastName, $username, $hashedPassword, $role_id);
        $stmt->execute();
        return ($stmt->affected_rows > 0);
    }

    function createAdmin($db, $id, $firstName, $lastName, $username, $password, $role_id, $isAdmin) {
        $query = "INSERT INTO users (id, first_name, last_name, username, password, role_id, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $hashedPassword = sha1($password);
        $stmt = $db->prepare($query);
        $stmt->bind_param('issssii', $id, $firstName, $lastName, $username, $hashedPassword, $role_id, $isAdmin);
        $stmt->execute();
        return ($stmt->affected_rows > 0);
    }
