<?php

/**
* @Author Paul, Will, Nicholas, Kylee
* @file
* Test file intended for doxygen testing
*/

session_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();
header("Location: /index.php"); /* Redirect browser */
exit();
?>
