<?php
session_start();
session_unset();
session_destroy();
header("Location: homepage.php"); // Redirect to the login page
exit();
?>
