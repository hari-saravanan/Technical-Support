<?php
session_start();

require_once "./assets/utils/db_connect.php";
include "./assets/utils/queries/users_queries.php";
include "./assets/utils/initial_setup/admin_setup.php";  // DEVELOPMENT ONLY

$userFeedback = null;

// Entry should only be from login form via POST request
if (IsSet($_POST) && IsSet($_POST["username"]) && IsSet($_POST["password"])) {

    // POST request and user has entered data in both form fields
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Data in both fields so check login credentials
    $userData = userLogin($db, $username, $password);
    if ($userData['id'] != null) {
        // Valid login credentials so set session variable and redirect
        $_SESSION["user"] = $userData['id'];
        $_SESSION["username"] = $username;
        $db->close();
        header("Location: ./dashboard.php");
        exit();
    } else {

        // Invalid login credentials so inform user
        $userFeedback = "Username and password did not match.";
    }
}

// Incomplete or no data in form fields
session_destroy();
$db->close();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <main>
        <section>
            <div class="container">
                <div class="row justify-content-center align-items-center" style="height:100vh">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($userFeedback != null) echo '<p id="feedback">' . $userFeedback . '</p>' ?>
                                <form action="" autocomplete="off" method="post">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" id="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" id="login" class="btn btn-primary">login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
