<?php ob_start();
    
session_start();

include 'connection.php';
if(isset($_SESSION['auth'])){
    echo "<script>window.top.location='index.php';</script>"; exit;
  
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/index.php';</script>"; exit;

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["lemail"];
    $password = $_POST["lpass"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL )) {
        echo "<script>alert('Invaid email');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/index.php';</script>"; exit;


    }
    if(strlen($password)<4 || strlen($password)>30){
        echo "<script>alert('Invaid password');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/index.php';</script>"; exit;


    }
    $sql = "SELECT * from enduser where email='" . $email . "' and password='" . $password . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['auth'] = true;
        $_SESSION['email'] = $email;
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/index.php';</script>"; exit;

    }
    else{
        echo "<script>alert('Invaid email Or password');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/index.php';</script>"; exit;

    }
}


ob_end_flush();
?>