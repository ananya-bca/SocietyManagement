<?php
session_start();
include 'config.php';
include 'curd_functions.php';

$id = $_GET['id'];

$select = "SELECT status from contact_us WHERE id = $id";
$result = mysqli_query($conn, $select);
if ($result) {
    $status = $row['status'];
    echo "Status: " . $status;
}
if($status == ""){
    $update = "UPDATE contact_us SET status = 'Contacted' WHERE id = $id";
    $qry = mysqli_query($conn, $update);
}

header('location:contact.php');
?>
