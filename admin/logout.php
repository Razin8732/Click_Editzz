
<?php ob_start();
include 'connection.php';
session_start();

if(isset($_SESSION['auth_a'])){
    session_destroy();
    echo "<script>window.top.location='/RAZIN/web2/admin/login.php';</script>"; exit;
  
}

?>