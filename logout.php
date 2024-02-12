<?php
// Start session if not already started
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a different page after logout
header("Location: login.php"); // Replace "index.php" with the page you want to redirect to after logout
exit;
?>
