<?php
// starting the session
session_start();
session_unset(); // unset the data of the session
session_destroy(); // destroying the session
header('location:index.php');
exit();
?>