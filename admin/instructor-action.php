<?php  
//action.php

if($_GET['from']=='instructor'){
include 'connection.php';

$input = filter_input_array(INPUT_POST);
$name = mysqli_real_escape_string($conn, $input["name"]);
$email = mysqli_real_escape_string($conn, $input["email"]);
$password = mysqli_real_escape_string($conn, $input["password"]);

if($input["action"] === 'edit')
{
 $query = "UPDATE instructor SET name = '".$name."', email = '".$email."' ,password='".$password."' WHERE id = '".$input["id"]."' ";

 mysqli_query($conn, $query);

}
if($input["action"] === 'delete')
{
 $query = "DELETE FROM instructor WHERE id = '".$input["id"]."'";
 mysqli_query($conn, $query);
 
}
}
echo json_encode($input);

if($_GET['from']=='enduser'){
    include 'connection.php';
    
    $input = filter_input_array(INPUT_POST);
    
    $name = mysqli_real_escape_string($conn, $input["name"]);
    $email = mysqli_real_escape_string($conn, $input["email"]);
    $password = mysqli_real_escape_string($conn, $input["password"]);
    
    if($input["action"] === 'edit')
    {
     $query = "UPDATE enduser SET name = '".$name."', email = '".$email."' ,password='".$password."' WHERE id = '".$input["id"]."' ";
    
     mysqli_query($conn, $query);
    
    }
    if($input["action"] === 'delete')
    {
     $query = "DELETE FROM enduser WHERE id = '".$input["id"]."'";
     mysqli_query($conn, $query);
     
    }
 }
 echo json_encode($input);

 

 if($_GET['from']=='pbyuser'){
    include 'connection.php';
    
    $input = filter_input_array(INPUT_POST);
    
    $name = mysqli_real_escape_string($conn, $input["name"]);
    $email = mysqli_real_escape_string($conn, $input["email"]);
    $password = mysqli_real_escape_string($conn, $input["password"]);
    
    if($input["action"] === 'edit')
    {
     $query = "UPDATE payment_by_user SET i_id = '".$email."' ,u_id='".$password."' WHERE id = '".$input["id"]."' ";
    
     mysqli_query($conn, $query);
    
    }
    if($input["action"] === 'delete')
    {
     $query = "DELETE FROM payment_by_user WHERE id = '".$input["id"]."'";
     mysqli_query($conn, $query);
     
    }
 }
 echo json_encode($input);
?>