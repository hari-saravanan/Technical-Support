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
    <title>Dashboard</title>
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-user = '<?php
                            echo $user ?>' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <div>
                <h1 class="alignleft">All Questions<span>(<?php
                        echo getQuestionCount($db) ." results";
                        ?>)</span></h1>
                <div><button id="question" class="btn btn-primary alignright">Ask Question</button></div>
            </div>
        </section>
        <br><br><br>
        <section>
            <div>
                <table class="table table-striped" id="all-questions">
                    <?php
                    $result = getQuestions($db);
                    if ($result->num_rows > 0) {
                        echo "<tr><th>Title</th><th>Description</th><th>is Solved</th></tr>";
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr class='clickable-row' data-id='".$row["id"]."'><td>".$row["title"]."</td><td>".$row["description"]."</td>
                                    <td>".($row["is_solved"] == '1' ? 'true' : 'false')."</td></tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </table>
            </div>
        </section>
    </main>
</body>
<script src="assets/js/dashboard-services.js"></script>
</html>

