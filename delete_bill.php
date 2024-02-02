<?php
session_start();

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];
include 'curd_functions.php';
$res = delete_data($id, 'bills', 'bill_id');
header('location:bills.php');

}
else{
  header('location:admin_login.php');
}
?>
