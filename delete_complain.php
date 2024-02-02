<?php
/* This code is written in PHP and it is used to delete a specific record from the database table - complain. */

session_start();

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];
include 'curd_functions.php';
$res = delete_data($id, 'complain', 'complain_id');
$r = delete_data($id, 'complain_reply', 'complain_id');

header('location:complaints.php');

}
else{
  header('location:admin_login.php');
}
?>
