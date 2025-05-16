<?php
session_start(); // to use the $_SESSION array
session_unset(); // to remove all data in the $_SESSION array 
session_destroy(); // to remove all session data in the server 
session_write_close();
setcookie(session_name(),'',0,'/'); // to delete cookies data
session_regenerate_id(true);
header("location: index.php"); // redirect the user to another page
?>