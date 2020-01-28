<?php

//  if ($_SERVER["REQUEST_METHOD"] == "POST") {

     if($_GET['from']=='instructor'){
  
    include 'connection.php';
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql = "INSERT INTO `instructor`(name,email,password) VALUES ('".$name."','".$email."','".$password."')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
}



// end user insert start
if($_GET['from']=='enduser'){
  
    include 'connection.php';
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql = "INSERT INTO `enduser`(name,email,password) VALUES ('".$name."','".$email."','".$password."')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
}
// edn user insert end

// end user payment insert start
if($_GET['from']=='pbyuser'){
  
    include 'connection.php';
	// $name=$_POST['name'];
	$userid=$_POST['email'];
	$courseid=$_POST['password'];
	$sql = "INSERT INTO `payment_by_user`(u_id,c_id) VALUES ('".$userid."','".$courseid."')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
}
// edn user payment insert end


//  }
?>