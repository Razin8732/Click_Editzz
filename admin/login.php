<?php  session_start();
ob_start(); ?>

<?php

if(isset($_SESSION['auth_a'])){
  echo "<script>window.top.location='index.php';</script>"; exit;

}
// if ($_SERVER["REQUEST_METHOD"] == "GET") {
//   echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/admin/index.php';</script>"; exit;

// }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin</title>
  </head>
  <body style="background-color: #ffcba4">
    <?php include 'connection.php';?>


    <form method="post">
    <div class="container rounded mt-5">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Admin Sign In</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="email" name="lemail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="lpass" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    </form>

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST["lemail"];
  $password = $_POST["lpass"];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL )) {
      echo "<script>alert('Invaid email');</script>";
      // echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/login.php';</script>"; exit;


  }
  if(strlen($password)<4 || strlen($password)>30){
      echo "<script>alert('Invaid password');</script>";
      // echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/login.php';</script>"; exit;


  }
  $sql = "SELECT * FROM `admin` WHERE email='" . $email . "' and password='" . $password . "'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $_SESSION['auth_a'] = true;
      $_SESSION['email_a'] = $email;
      echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/admin/index.php';</script>"; exit;

  }
  else{
      echo "<script>alert('Invaid email Or password');</script>";
      // echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/admin/index.php';</script>"; exit;

  }
}


ob_end_flush();


?>