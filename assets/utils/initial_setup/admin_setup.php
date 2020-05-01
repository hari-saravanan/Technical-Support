<?php
// Development ONLY setup of user table and admin user if required
createUsersTable($db);     // Create user table if required

$result = findUser($db, 'admin'); // Attempt to find default admin
if ($result['username'] == null) {
    createAdmin($db, 1, 'admin', 'admin', 'admin', 'password', 1, 1);
}