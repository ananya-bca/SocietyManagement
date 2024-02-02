<?php
/* This code is written in PHP and it is used to delete a specific record from the database table - notice. */

session_start();

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];
include 'curd_functions.php';
$res = delete_data($id, 'notice', 'n_id');

header('location:notice.php');

}
else{
  header('location:admin_login.php');
}
?>
