<?php
session_start();
if(!isset($_SESSION['auth_a'])){
    echo "<script>window.top.location='login.php';</script>"; exit;
  
  }
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin</title>
</head>

<body>
    <?php include 'header.php';?>
    <?php include 'connection.php';?>


    <div class="card m-auto" style="width: 20rem;top:10rem;">
        <ul class="list-group list-group-flush align-self-center">
            <button class="btn btn-default border-bottom" style="width: 20rem;">
                <a class="list-group-item stretched-link" href="instructors.php">Instructor</a>
            </button>
            <button class="btn btn-default border-bottom">
                <a class="list-group-item stretched-link" href="endusers.php">End User</a>
            </button>
            <button class="btn btn-default">
                <a class="list-group-item stretched-link" href="pament-by-enduser.php">Payment by enduser</a>
            </button>
        </ul>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
  ob_end_flush();
  ?>