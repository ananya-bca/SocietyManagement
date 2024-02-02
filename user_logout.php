<?php
// Logout page for the user.

// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Prevent caching of the current page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// Redirect to a login page or any other appropriate page after logout
header("Location: user_login.php");
exit();
?>

