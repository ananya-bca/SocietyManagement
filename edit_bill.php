<?php
/* This code is written in PHP that set bill staus from pending to paid. */

session_start();
include 'config.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

include 'curd_functions.php';

$id = $_GET['id'];

$select = "SELECT status from bills WHERE bill_id = $id";
$result = mysqli_query($conn, $select);
if ($result) {

    $row = $result->fetch_assoc();
    $status = $row['status'];
    echo "Status: " . $status;
}
if($status == "pending"){
    $update = "UPDATE bills SET status = 'Paid' WHERE bill_id = $id";
    $qry = mysqli_query($conn, $update);
}

header('location:bills.php');

}
else{
  header('location:admin_login.php');
}
?>