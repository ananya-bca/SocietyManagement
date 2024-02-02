<?php
/* This code is written in PHP and it is used to delete a specific record from the database table - members. */

session_start();
include 'config.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];
include 'curd_functions.php';

$select = "SELECT wing, flat_number FROM members WHERE member_id = $id";
$result = mysqli_query($conn, $select);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $wing = $row['wing'];         
    $flat_num = $row['flat_number']; 
    
    // Update 'flat' table
    $update = "UPDATE flat SET status = 'Available' WHERE flat_wing = '$wing' AND flat_number = '$flat_num'";
    $qry = mysqli_query($conn, $update);
}

$res = delete_data($id, 'members', 'member_id');

header('location: members.php');
}
else{
  header('location:admin_login.php');
}
?>