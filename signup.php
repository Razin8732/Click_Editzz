<?php ob_start();
include 'connection.php';
session_start();

if(isset($_SESSION['auth'])){
    echo "<script>window.top.location='/RAZIN/web2/index.php';</script>"; exit;
  
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "<script>window.top.location='/RAZIN/web2/index.php';</script>"; exit;

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["semail"];
    $password = $_POST["spassword"];
    $name=$_POST["sname"];


       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        header("Location :/RAZIN/web2/error.php?error='".$error."'");
    }
   
    $getuser="SELECT * from enduser where email='".$email."'";
    $user=$conn->query($getuser);
    if($user->num_rows >0){
        echo "<script type='text/javascript'>alert('User already exists');</script>"; exit;
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/index.php';</script>"; exit;
    }
  

    $sql = "INSERT INTO enduser(name,email,password) VALUES('".$name."','".$email."','".$password."')";
    $result = $conn->query($sql);
    if(!$result){
        echo "<script type='text/javascript'>alert('Signup error');</script>"; exit;
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/index.php';</script>"; exit;
    }
    else{
        $_SESSION['auth'] = true;
        $_SESSION['email'] = $email;
        echo "<script>window.top.location='/RAZIN/web2/index.php';</script>"; exit;
    }

    
}

?>


<?php
ob_end_flush();
?>