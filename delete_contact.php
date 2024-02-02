<?php
/* This code is written in PHP and it is used to delete a specific record from the database table - contact_us. */

session_start();

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];
include 'curd_functions.php';
$res = delete_data($id, 'contact_us', 'id');

header('location:contact.php');

}
else{
  header('location:admin_login.php');
}
?>
