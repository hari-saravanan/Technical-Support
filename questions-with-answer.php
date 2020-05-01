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
    <title id="head"></title>
    <link rel="stylesheet" href="assets/css/styles.css">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="./dashboard.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <?php if(strtoupper($user) == 'ADMIN')
                        echo '<li class="nav-item">
                            <a class="nav-link" href="./user-upload.php">Upload Users</a>
                        </li>';

                    ?>
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
    <section>
        <input type="hidden" id="get-session-id"><?php $id ?>
            <h1 id="title" style="text-align: center;"></h1>

        <hr>
        <div>
            <p id="description"></p>
        </div>
        <br>
    </section>
    <hr>
    <section id="answers">

    </section>
    <section>
        <h3>Your Answer</h3>
        <br>
        <textarea rows="10" cols="100" id="answer-text"></textarea>
        <br>
        <button id="ans-submit">Submit</button>
    </section>
</main>
</body>
<script src="assets/js/question-services.js"></script>
</html>


