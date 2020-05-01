<?php
session_start();
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $id = $_SESSION['user'];
    include './assets/utils/db_connect.php';
    include './assets/utils/queries/questions_queries.php';
} else {
    $user = null;
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Upload Users</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<main>
    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="./dashboard.php">Technical Support</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./user-upload.php">Upload Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome <?php
                            echo $user ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right text-right float-right" aria-labelledby="navbarDropdownMenuLink">
                            <!--                                <a class="dropdown-item" href="#">Action</a>-->
                            <!--                                <a class="dropdown-item" href="#"></a>-->
                            <a class="dropdown-item" href="logout.php">Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <br>
    <section>
        <div class="container">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h4 class="card-title">Ask Question</h4>
                    <form action="./assets/ajax-services/ask-question.php" method="post">
                        <div class="form-group">
                            <label for="title">Title :</label>
                            <input type="text" class="form-control" placeholder="Please enter the title" id="title" name="title">
                            <input type="hidden" value="<?php$id?>" id="user-id" name="user-id">
                        </div>
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <textarea class="form-control" name="description" placeholder="Include all the information someone need to answer your question" id="description" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>