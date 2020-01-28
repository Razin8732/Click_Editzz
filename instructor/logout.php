
<?php ob_start();
include '../connection.php';
session_start();

if(isset($_SESSION['auth_i'])){
    session_destroy();
    echo "<script>window.top.location='/RAZIN/web2/instructor/index.php';</script>"; exit;
  
}

?>