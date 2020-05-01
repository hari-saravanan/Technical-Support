<?php
session_start();
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
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
                    <li class="nav-item active">
                        <a class="nav-link" href="./user-upload.php">Upload Users<span class="sr-only">(current)</span></a>
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
                    <h4 class="card-title">Upload Users</h4>
                        <p class="card-text">
                            Select role : <select id="roles"></select>
                            <br>
                            Kindly select a file :
                            <input type="file" id="fileUpload"">
                            <button id="submit">Submit</button>
                        </p>
                        <p id="sampleData">Kindly note that the First row in the excel should be as follows
                        <table class="table table-striped" id="sampleTable">
                            <thead>
                            <tr>
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Reg No</td>
                            </tr>
                            </thead>
                        </table></p>
                        <p id="jsonData"></p>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
<script src="assets/utils/read-files.js"></script>
</html>